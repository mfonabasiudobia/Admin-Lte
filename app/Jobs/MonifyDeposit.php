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

class MonifyDeposit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function handle(): void
    {
        try {
            //code...
            DepositRepository::monifyDeposit($this->data);
        } catch (\Throwable $th) {
            //throw $th;
            Storage::put("monnifyissueerrror.txt", (string) $th);
        }
    }
}
