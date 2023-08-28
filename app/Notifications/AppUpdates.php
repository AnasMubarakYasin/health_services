<?php

namespace App\Notifications;

use App\Dynamic\Updates;
use App\Mail\AppUpdates as MailAppUpdates;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use NotificationChannels\Telegram\TelegramMessage;

class AppUpdates extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $stakeholder, public Updates $updates)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(User $user): array
    {
        $via = ['mail'];
        if (isset($user->chat_id)) {
            array_push($via, 'telegram');
        }
        return $via;
    }

    public function toMail(User $user): Mailable
    {
        return (new MailAppUpdates($this->stakeholder, $this->updates))->to($user->email);
    }
    public function toTelegram(User $user)
    {
        $url = str_starts_with($this->updates->link, "http://localhost") ? "http://bladerlaiga.my.id/" : $this->updates->link;
        $changes = preg_replace_callback("/([|{\[\]*_~}+)(#>!=\-.])/s", fn($m) => "\\".$m[0], $this->updates->changes);
        $last_version = preg_replace_callback("/([|{\[\]*_~}+)(#>!=\-.])/s", fn($m) => "\\".$m[0], $this->updates->last_version);
        $version = preg_replace_callback("/([|{\[\]*_~}+)(#>!=\-.])/s", fn($m) => "\\".$m[0], $this->updates->version);
        return TelegramMessage::create()
            ->options([
                'parse_mode' => 'markdownv2',
            ])
            ->to($user->chat_id)
            ->line("Application New Updates\!\n")
            ->line("Dear {$this->stakeholder}")
            ->line("The {$this->updates->name} *v{$last_version}* was update to *v{$version}*\.")
            ->line("You can see *[here]({$url})*\.\n")
            ->line("What's Changes")
            ->line("{$changes}\n")
            ->line("Regards,")
            ->line("{$this->updates->vendor}\.")
            ->button('Visit App', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(User $user): array
    {
        return [
            //
        ];
    }
}
