<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Http\Livewire\BaseComponent;
use App\Repositories\TransactionRepository;
use AppHelper;

class Show extends BaseComponent
{

    public $transaction, $status, $nextTransaction, $previousTransaction;

    public function mount($id)
    {
        $this->fill([
            'transaction' => TransactionRepository::getById($id),
            'nextTransaction' => TransactionRepository::nextTransaction($id),
            'previousTransaction' => TransactionRepository::previousTransaction($id)
        ]);
    }

    public function updatedStatus($value)
    {
        try {

            // throw_if(auth()->user()->cannot('edit_order_status'), "You dont have permission to update transaction status");

            throw_unless(TransactionRepository::updateTransactionStatus($value, $this->transaction->id), "Failed to update transaction status");

            toast()->success("Transaction Status has been updated")->push();

            $this->emit('refresh');
        } catch (\Throwable $e) {
            toast()->danger($e->getMessage())->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.transaction.show')->layout('layouts.admin-base');
    }
}
