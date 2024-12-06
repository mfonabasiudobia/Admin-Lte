<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Http\Livewire\BaseComponent;
use App\Models\Transaction;
use App\Mail\OtpNotification;
use App\Jobs\Mailable;
use App\Models\User;
// use App\Models\Withdrawal;
use App\Helpers\Statistics;
use App\Repositories\WalletRepository;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Mail;
use Pdf;

class Home extends BaseComponent
{

    public $currentStats = "today", $stats;

    public function mount()
    {
        // dd(realpath(base_path()) . "/" . gs()->logo);
        // dd(public_path(gs()->logo));
        // $trx = Transaction::find("9d34a6d9-39e5-49b9-87e7-368dc858e3b5");

        // $data = [
        //     'trx' => $trx->trx,
        //     'logo' => asset(gs()->logo),
        //     'date' => $trx->created_at->format('Y-m-d H:i'),
        //     'cardType' => $trx->card_type,
        //     'status' => $trx->status,
        //     'quantity' => $trx->quantity,
        //     'price' => number_format($trx->price, 2),
        //     'amount' => number_format($trx->amount, 2),
        // ];

        // $pdf = Pdf::loadView('emails.invoice-pdf', $data)->setOptions(['defaultFont' => 'sans-serif']);;

        // dd($pdf->output());

        $this->updatedCurrentStats();
    }

    public function updatedCurrentStats()
    {


        // $this->stats['customer_time_series_analysis'] = [];
        // //Statistics::getSumByMonthInAYear(User::query(),$this->currentStats,'total_amount');
        $this->stats['orders_time_series_analysis'] = []; //Statistics::getTotalByMonthInAYear(Transaction::query(), $this->currentStats);
        $this->stats['customer_time_series_analysis'] = []; // Statistics::getTotalByMonthInAYear(User::query(), $this->currentStats);

        $this->dispatchBrowserEvent('showgraph');
    }


    public function render()
    {
        return view('livewire.admin.dashboard.home')->layout('layouts.admin-base');
    }
}
