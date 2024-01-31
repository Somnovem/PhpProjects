<?php

namespace App\Jobs;

use App\Services\Photos\OptimizeUploadPhotoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OptimizeUploadPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $photo_id,
        private int $user_id,)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $photoService = new OptimizeUploadPhotoService($this->photo_id,$this->user_id);
        $photoService->handle();
    }
}
