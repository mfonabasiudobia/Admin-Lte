<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseComponent;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Jobs\GenerateVirtualAccounts;

class Show extends BaseComponent
{
    public $user;

    public $type = 'credit', $amount = 0, $account_status = 'active';

    public $transaction, $status, $nextUser, $previousUser;

    public function mount($id)
    {
        $this->user = UserRepository::getUserById($id);

        $this->fill([
            'account_status' => $this->user->account_status,
            'previousUser' => UserRepository::nextUser($id),
            'nextUser' => UserRepository::previousUser($id)
        ]);
    }


    public function updateWalletBalance()
    {
        $this->validate([
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:1'
        ]);


        try {
            $trx = WalletRepository::manualDeposit($this->user, [
                'amount' => $this->amount,
                'type' => $this->type
            ]);

            if ($trx) {
                toast()->success('Wallet Balance Updated')->pushOnNextPage();
            }

            $this->resetExcept(['user']);
            $this->key = rand(0, 2000);
        } catch (\Throwable $e) {
            return toast()->danger($e->getMessage())->push();
        }
    }


    public function updateUserStatus()
    {
        $this->validate([
            'account_status' => 'required|in:active,blocked'
        ]);

        try {
            $trx = UserRepository::updateUserStatus($this->user, [
                'account_status' => $this->account_status,
            ]);

            if ($trx) {
                toast()->success('User Status Updated')->push();
            }

            $this->resetExcept(['user']);
            $this->key = rand(0, 2000);
        } catch (\Throwable $e) {
            return toast()->danger($e->getMessage())->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.user.show')->layout('layouts.admin-base');
    }
}
