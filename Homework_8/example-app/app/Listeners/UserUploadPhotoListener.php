<?php

namespace App\Listeners;

use App\Events\UserUploadPhotoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserUploadPhotoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserUploadPhotoEvent $event): void
    {
        info('Saved photo: ' . $event->model);
    }
}
