<section class="content-wrapper">
    <x-loading />

    <section class="flex justify-between items-center">
        <h1 class="title"><span class="capitalize">User Details</h1>
        <nav class="flex items-center space-x-2">
            <a id="Previous Transaction"
                href="{{ $previousUser ? route('admin.user.show', ['id' => $previousUser->id]) : 'javascript:void(0)' }}"
                class="btn btn-primary btn-xs">
                <i class="las la-chevron-left"></i>
            </a>
            <a title="Next Transaction"
                href="{{ $nextUser ? route('admin.user.show', ['id' => $nextUser->id]) : 'javascript:void(0)' }}"
                class="btn btn-primary btn-xs">
                <i class="las la-chevron-right"></i>
            </a>
        </nav>
    </section>


    <div class="shadow-xl rounded-xl relative overflow-hidden bg-white">
        <div class="min-h-[20vh] bg-purple-100 relative">
            <img src="{{ asset($user->profile_image) }}" alt=""
                class="shadow-xl absolute left-5 -bottom-10 ring ring-4 ring-white rounded-full h-[70px] md:h-[120px] w-[70px] md:w-[120px] object-cover" />
        </div>

        <section class="mt-10 p-5">
            {{-- <h2 class="font-bold">{{ $user->fullname }}</h2> --}}
            <ul class="list-disc list-inside font-light text-sm flex flex-col md:flex-row md:items-center md:space-x-5">
                {{-- <li>{{ $user->username }}</li> --}}
                <li>{{ $user->email }}</li>
            </ul>

            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="absolute top-5 right-5 text-xl">
                <i class="las la-edit"></i>
            </a>
        </section>
    </div>


    <section class="grid md:grid-cols-2 gap-10">
        <section>
            <table class="text-left">
                {{-- <tr>
                    <th>Referral Code:</th>
                    <td>{{ $user->referral_code }}</td>
                </tr>
                <tr>
                    <th>Wallet Balance:</th>
                    <td>{{ $user->wallet_balance }}</td>
                </tr> --}}
                <tr>
                    <th>Account Verified:</th>
                    <td>{{ $user->is_verified ? 'Yes' : 'No' }}</td>
                </tr>
            </table>
        </section>

        {{--
        @if (auth()->user()->can('edit_user'))
        <section>
            <form class="space-y-3" wire:submit.prevent='updateWalletBalance'>
                <div class="form-group">
                    <label for="">Type</label>
                    <select wire:model.defer='type' class="form-control">
                        <option value="credit" selected>Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                    @error('type')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" class="form-control" wire:model.defer='amount' placeholder="Amount" />
                    @error('amount')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
                </div>
            </form>
        </section>
        @endIf --}}


        <section class="space-y-5">
            <h2 class="font-bold">Update User Status </h2>

            <form class="space-y-3" wire:submit.prevent='updateUserStatus'>
                <div class="form-group">
                    <label for="">Status</label>
                    <select wire:model.defer='account_status' class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="blocked">Blocked</option>
                    </select>
                    @error('status')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
                </div>
            </form>
        </section>
    </section>



    <section class="py-5">
        <h2>Transactions</h2>

        @livewire('admin.transaction.tables.home', ['user_id' => $user->id, 'status' => 'all'], key($key))
    </section>


    <section class="py-5">
        <h2>Cards</h2>

        @livewire('admin.card.tables.home', ['user_id' => $user->id, 'status' => 'all'], key($key . '-card'))
    </section>


</section>