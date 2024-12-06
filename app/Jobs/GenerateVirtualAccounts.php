<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Storage;

class GenerateVirtualAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //code...
            // WalletRepository::generateVirtualAccount($this->data['user']);

            WalletRepository::generateVirtualAccount($this->data['user'], $this->data['bankCode']);
        } catch (\Throwable $th) {
            //throw $th;
            Storage::put("monnifyissueerrror.txt", (string) $th);
        }
    }
}
