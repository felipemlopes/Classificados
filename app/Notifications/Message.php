<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Message extends Notification  implements ShouldQueue
{
    use Queueable;
    /**
     * @var \App\Models\Message
     */
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Message $message)
    {
        $this->message = $message;
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
        $link = route('message.show',$this->message->conversation_id);

        return ( new MailMessage )
            ->subject( 'Nova mensagem' )
            ->line( "Você está recebendo este email, por que você recebeu uma nova mensagem." )
            ->action( 'Ver mensagens', $link )
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
