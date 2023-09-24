<?php

namespace App\Notifications;

use App\Models\Midwife;
use App\Models\Order;
use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class OrderScheduled extends Notification
{
    use Queueable;

    public string $title = "";
    public string $body = "";
    public string $icon = "";
    public array $action = [];
    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
        $day = Carbon::parse($this->order->schedule)->translatedFormat('d F');
        $start = date('H:i', strtotime($this->order->schedule_start));
        $end = date('H:i', strtotime($this->order->schedule_end));
        $this->title = "Orders Scheduled";
        $this->body = "Your orders scheduled at $day $start-$end";
        $this->icon = config('dynamic.application.logo');
        $this->action[Patient::class] = route('web.patient.history.detail', ['order' => $this->order]);
        $this->action[Midwife::class] = route('web.midwife.history.detail', ['order' => $this->order]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon($this->icon)
            ->body($this->body)
            ->action("View Orders", $this->action[$notifiable::class])
            ->tag($notification->id)
            ->renotify()
            ->options(['TTL' => 1000]);
        // ->data($this->order->toArray())
        // ->badge()
        // ->dir()
        // ->image()
        // ->lang()
        // ->renotify()
        // ->requireInteraction()
        // ->tag()
        // ->vibrate()
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'icon' => $this->icon,
            'action' => $this->action[$notifiable::class],
            'data' => $this->order->toArray(),
        ];
    }
}
