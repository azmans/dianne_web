<?php

namespace App\Notifications;

use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VendorApproved extends Notification
{
    use Queueable;

    private $new_vendor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Vendor $new_vendor)
    {
        $this->new_vendor = $new_vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('admin@dianne.com', 'DIANNE Admin')
            ->line('Your account with the email ' . $this->new_vendor->email . ' at DIANNE has been approved.
                You may now log in to your account.')
            ->action('Log In', route('vendor.login'));
    }

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
