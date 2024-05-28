<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendQuoteNotification extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pedido de cotação')
            ->greeting('Olá!')
            ->line('<strong>Nome: </strong>' . $this->data['user_name'])
            ->line('<strong>Email: </strong>' . $this->data['user_email'])
            ->line('<strong>Empresa: </strong>' . $this->data['company_name'])
            ->line('<strong>País: </strong>' . $this->data['country_name'])
            ->line('<strong>Produto: </strong>' . $this->data['product_name'])
            ->line('<strong>Seleção: </strong>' . $this->data['selection_name'])
            ->line('<strong>Part number: </strong>' . $this->data['selection_part_number'])
            ->line('<strong>Descrição: </strong>' . $this->data['selection_description'])
            ->line('<strong>Preço unitário: </strong>' . $this->data['price'])
            ->line('<strong>Preço total: </strong>' . $this->data['final_price'])
            ->action('Ver pedido', url('https://appdssi.pt/admin/quote-requests/' . $this->data['quote_request_id']))
            ->line('Obrigado por utilizar a nossa aplicação!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
