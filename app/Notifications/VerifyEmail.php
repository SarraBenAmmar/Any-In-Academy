<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $userType; // 'student' or 'instructor'

    public function __construct($userType)
    {
        $this->userType = $userType;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->greeting('Hello!')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $this->verificationUrl($notifiable))
            ->line('Thank you for using our application!');
    }

    protected function verificationUrl($notifiable)
    {
        $routeName = $this->userType === 'student' ? 'studentVerification.verify' : 'instructorVerification.verify';

        return URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(60),
            ['id' => $notifiable->getKey()]
        );
    }
}
