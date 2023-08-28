<?php

namespace App\Console\Commands;

use App\Dynamic\Updates;
use App\Models\User;
use App\Notifications\AppUpdates;
use Illuminate\Console\Command;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AppNotifyUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-updates
                                {emails?* : The emails client want to notify}
                                {--unsend : don"t send notification}
                                {--changes : show changes}
                                {--test : test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Application Updates to Client';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $updates = new Updates();
        try {
            $updates->load();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return Command::FAILURE;
        }
        $updates->generate_changes();

        $this->option('changes') && $this->line("Changes\n$updates->changes");

        $emails = $this->argument('emails');
        $dev_emails = config('dynamic.stakeholder.dev.mails');
        $dev_chat_id = config('dynamic.stakeholder.dev.chat_id');
        if ($this->option('test')) {
            $emails = ['bladerlaiga@gmail.com'];
            $dev_emails = [];
        }
        if (!$emails) {
            $emails = config('dynamic.stakeholder.client.mails');
            $chat_id = config('dynamic.stakeholder.client.chat_id');
        }
        if (!$dev_emails) {
            $this->error("Email Dev Empty");
            return Command::INVALID;
        }
        $this->line("Notify Updates to Client: " . join(", ", $emails));
        $this->line("Notify Updates to Dev: " . join(", ", $dev_emails));
        try {
            if (!$this->option('unsend')) {
                if (!$emails) {
                    $this->warn("Notify Client Ignored");
                } else {
                    $client = new User();
                    $client->email = $emails;
                    $client->chat_id = $chat_id;
                    Notification::sendNow($client, new AppUpdates("Client", $updates));
                }
                $contributor = new User();
                $contributor->email = $dev_emails;
                $contributor->chat_id = $dev_chat_id;
                Notification::sendNow($contributor, new AppUpdates("Contributor", $updates));
            }
            $updates->save();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return Command::FAILURE;
        }
        $this->info("Notify Update success");
        return Command::SUCCESS;
    }
}
