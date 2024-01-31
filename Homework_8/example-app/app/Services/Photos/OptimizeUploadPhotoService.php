<?php

namespace App\Services\Photos;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class OptimizeUploadPhotoService
{
    private int $preloadWidth = 100;
    private int $preloadHeight = 100;
    //private int $scaleToHeight = 100;

    public function __construct(
        private int $photo_id,
        private int $user_id,)
    {

    }

    public function handle(): void
    {
        $fileDir = 'photos/user_id_' . $this->user_id . '/photo_id_' . $this->photo_id  .'/';

        $manager = new ImageManager(new Driver());
        $photoContent = Storage::get($fileDir . $this->photo_id. '.original.jpg');
        $photoImage = $manager->read($photoContent);

        //Store optimized original
        Storage::put($fileDir . $this->photo_id . '.webp', $photoImage->toWebp());

        //$photoImage->scale(height:$this->scaleToHeight);
        $photoImage->scale($this->preloadWidth, $this->preloadHeight);

        //Store optimized preload
        Storage::put($fileDir . $this->photo_id . '.thumb.webp', $photoImage->toWebp(60));
    }
}
