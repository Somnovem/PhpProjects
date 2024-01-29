<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Models\Mail\GreetMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegisterListener implements ShouldQueue
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
    public function handle(UserRegisterEvent $event): void
    {
        $user = $event->model;
        Mail::to($user->email)->send(new GreetMail());
        Log::debug('Email sent');
    }
}
