<?php

namespace App\Jobs;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;


class PreloadUploadedPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $preloadWidth = 100;
    private int $preloadHeight = 100;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public $photoPath)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $manager = new ImageManager(new Driver());
        $photoContent = Storage::get($this->photoPath);
        $photoImage = $manager->read($photoContent);
        $photoImage->scaleDown($this->preloadWidth, $this->preloadHeight);
        $directory = pathinfo($this->photoPath, PATHINFO_DIRNAME);
        $extension = pathinfo($this->photoPath, PATHINFO_EXTENSION);
        $filename = pathinfo($this->photoPath, PATHINFO_FILENAME);
        $preloadName = $filename . '_preload.' . $extension;
        $preloadPath = $directory . '/preloads/' . $preloadName;
        Storage::put($preloadPath, $photoImage->toJpeg());
        $photo = Photo::where('storage_path', $this->photoPath)->first();
        $photo->update([
            'storage_preloaded_path' => $preloadPath,
            'preloaded_url' => url(Storage::url($preloadPath)),
        ]);
    }
}
