<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdvertisementSuspended extends Notification implements ShouldQueue
{
    use Queueable;
    private $advertisement;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($advertisement)
    {
        $this->advertisement = $advertisement;
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
        $link = route('myaccount.advertisement');

        return ( new MailMessage )
            ->subject( 'Um anúncio seu expirou' )
            ->line( "Você está recebendo este email, por que um anúncio seu expirou e encontra-se suspenso. Acesse a sua conta caso queira republicá-lo." )
            ->action( 'Meus anúncios', $link )
            ->line( 'Obrigado!' );
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
