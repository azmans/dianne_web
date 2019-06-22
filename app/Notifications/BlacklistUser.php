<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BlacklistUser extends Notification
{
    use Queueable;

    private $blacklist_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $blacklist_user)
    {
        $this->blacklist_user = $blacklist_user;
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
            ->subject('Your account has been blacklisted...')
            ->from('admin@dianne.com', 'DIANNE Admin')
            ->line('Your account with the email ' . $this->blacklist_user->email . ' has been blacklisted because
                 you have violated the rules. If you have any concerns, please contact our administrators.');
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
