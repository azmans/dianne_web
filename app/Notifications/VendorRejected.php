<?php

namespace App\Notifications;

use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VendorRejected extends Notification
{
    use Queueable;

    private $vendor_rejected;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor_rejected)
    {
        $this->vendor_rejected = $vendor_rejected;
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
            ->line('Your registration to DIANNE with the email ' . $this->vendor_rejected->email . ' has 
                been rejected. Please double check your business credentials.')
            ->action('Sign up again', route('vendor.register'));
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
