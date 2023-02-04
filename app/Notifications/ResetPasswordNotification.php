<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    
    }

    // public function toMail($notifiable)
    // {
    //     $url = 'http://laragigs.test/resetpass/'. $token;
    //     // url(route('passreset.form', [
    //     //     'token' => $this->token,
    //     //     'email' => $notifiable->getEmailForPasswordReset(),
    //     // ], false));

    //     return (new MailMessage)
    //                 ->subject(__('Reset Your Password!'))
    //                 ->line('You are receiving this email because we received a password reset request for your account.')
    //                 ->action(__('Reset Password'), $url)
    //                 ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
