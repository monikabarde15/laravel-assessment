<?php 
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // store in DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'message' => "Your order #{$this->order->id} status updated to {$this->order->status}"
        ];
    }
}
