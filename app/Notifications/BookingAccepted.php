<?php

namespace App\Notifications;

use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingAccepted extends Notification
{
    use Queueable;

    private $vendor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
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
            ->subject($this->vendor->first_name . ' ' . $this->vendor->last_name . ' has accepted your booking...')
            ->from('admin@dianne.com', 'DIANNE Admin')
            ->line('A vendor by the name of ' . $this->vendor->first_name . ' ' . $this->vendor->last_name . ' has
                accepted your booking.')
            ->action('View Bookings', route('auth.booking-requests'));
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
