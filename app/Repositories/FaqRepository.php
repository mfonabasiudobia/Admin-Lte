<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Mail\OrderNotification;
use App\Repositories\WalletRepository;
use App\Repositories\UserRepository;
use App\Jobs\Mailable;
use Hash;

class FaqRepository
{
    public static function all(): Collection
    {
        return Faq::all();
    }


    public static function getById(string $id): Faq
    {
        return Faq::findOrFail($id);
    }

    public static function create(array $data): Faq
    {
        return Faq::create($data);
    }

    public static function update(array $data, string $id): bool
    {
        return Faq::find($id)->update($data);
    }
}
