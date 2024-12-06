<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\DepositRepository;
use Storage;

class SafeHavenDeposit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $details;
    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
        $this->onQueue('deposits');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //code...
            DepositRepository::safehavenDeposit($this->details);
        } catch (\Throwable $th) {
            //throw $th;
            Storage::put("safehavenissueerrror.txt", (string) $th);
        }
    }
}
