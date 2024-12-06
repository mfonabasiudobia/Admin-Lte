<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $card, $field;

    public function __construct($card, $field)
    {
        $this->card = $card;
        $this->field = $field;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if ($this->card->can_notify) {
            $connections = $this->card->connections()->get();

            // Iterate over each connection and send a notification
            foreach ($connections as $connection) {
                // Assuming connection has a 'user_id' field or something similar
                if ($connection->can_notify) {
                    $name = $this->card->first_name . " " . $this->card->last_name;

                    if ($this->field == 'situation_status') {
                        save_notification([
                            'title' => 'Status Updated',
                            'user_id' => $connection->user_id, // Notify the connection
                            'image' => $this->card->profile_image,
                            'card_id' => $this->card->id,
                            'content' => "$name made a status change."
                        ]);
                    } else if ($this->field == 'mobile_number') {
                        save_notification([
                            'title' => 'Contact Updated',
                            'user_id' => $connection->user_id, // Notify the connection
                            'image' => $this->card->profile_image,
                            'card_id' => $this->card->id,
                            'content' => "$name updated a contact number."
                        ]);
                    } else if ($this->field == 'email_address') {
                        save_notification([
                            'title' => 'Contact Updated',
                            'user_id' => $connection->user_id, // Notify the connection
                            'image' => $this->card->profile_image,
                            'card_id' => $this->card->id,
                            'content' => "$name updated an email address."
                        ]);
                    }
                }
            }
        }
    }
}
