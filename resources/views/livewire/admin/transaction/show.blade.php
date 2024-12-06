<section class="content-wrapper">
    <x-loading />

    <section class="flex justify-between items-center">
        <h1 class="title"><span class="capitalize">Transaction Details</h1>
        <nav class="flex items-center space-x-2">
            <a id="Previous Transaction"
                href="{{ $previousTransaction ? route('admin.transaction.show', ['id' => $previousTransaction->id]) : 'javascript:void(0)' }}"
                class="btn btn-primary btn-xs">
                <i class="las la-chevron-left"></i>
            </a>
            <a title="Next Transaction"
                href="{{ $nextTransaction ? route('admin.transaction.show', ['id' => $nextTransaction->id]) : 'javascript:void(0)' }}"
                class="btn btn-primary btn-xs">
                <i class="las la-chevron-right"></i>
            </a>
        </nav>
    </section>

    <section class="grid md:grid-cols-3 gap-5">
        <section class="md:col-span-2 rounded-lg border dark:border-gray-500 p-3 space-y-5">
            <header class="flex items-center justify-between">
                <section>
                    <h1 class="font-semibold text-xl">Transaction ID #{{ $transaction->trx }}</h1>
                    <div class="text-xs opacity-70">{{
                        $transaction->created_at->setTimezone('America/New_York')->format('d M, Y h:i A') }}</div>
                </section>

                {{-- <button class="btn btn-xs btn-primary">
                    <i class="las la-receipt"></i> Print Invoice
                </button> --}}


            </header>

            <section class="grid md:grid-cols-2 gap-5">
                <div>
                    {{-- <button class="btn btn-xs border border-primary dark:dark:border-gray-500">
                        <i class="las la-map-marker-alt"></i>
                        Show Location In Map
                    </button> --}}
                </div>

                <ul class="md:text-right text-sm space-y-2">
                    <li class="space-x-2">
                        <span>Transaction Status:</span>
                        @if ($transaction->status === 'pending')
                        <span class='bg-info text-white btn btn-xs'>Pending</span>
                        @elseif($transaction->order_status === 'failed')
                        <span class='bg-danger text-white btn btn-xs'>Failed</span>
                        @elseif($transaction->order_status === 'cancelled')
                        <span class='bg-warning text-white btn btn-xs'>Cancelled</span>
                        @elseif($transaction->order_status === 'completed')
                        <span class='bg-success text-white btn btn-xs'>Completed</span>
                        @else
                        <span class='bg-primary text-white btn btn-xs'>{{ $transaction->status }}</span>
                        @endIf
                    </li>
                </ul>
            </section>

            <section class="overflow-x-auto">

                <table class="table min-w-full">
                    <tr>
                        <td>Transaction Type:</td>
                        <td>{{ $transaction->remark }}</td>
                    </tr>
                    <tr>
                        <td>Amount:</td>
                        <td> {{ ac() . number_format($transaction->amount) }}</td>
                    </tr>
                    <tr>
                        <td>Charge:</td>
                        <td> {{ ac() . number_format($transaction->charge) }}</td>
                    </tr>
                    <tr>
                        <td>Discount:</td>
                        <td> {{ ac() . number_format($transaction->discount_amount) }}</td>
                    </tr>
                    <tr>
                        <td>Profit:</td>
                        <td> {{ ac() . number_format($transaction->profit) }}</td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td> {{ ac() . number_format($transaction->price) }}</td>
                    </tr>

                    <tr>
                        <td>Quantity:</td>
                        <td> {{ number_format($transaction->quantity) }}</td>
                    </tr>

                    <tr>
                        <td>Details:</td>
                        <td> {{ $transaction->details }}</td>
                    </tr>
                    <tr>
                        <td>{{ $transaction->user->fullname }} Paid:</td>
                        <td> {{ ac() . number_format($transaction->final_amount) }}</td>
                    </tr>


                    <tr>
                        <td>Query1</td>
                        <td class="overflow-wrap-break-word"> {{ force_string($transaction->query1) }}</td>
                    </tr>

                    <tr>
                        <td>Query2</td>
                        <td class="overflow-wrap-break-word"> {{ force_string($transaction->query2) }}</td>
                    </tr>

                    <tr>
                        <td>Payload</td>
                        <td class="overflow-wrap-break-word"> {{ $transaction->ip_address }}</td>
                    </tr>

                    <tr>
                        <td>Payload</td>
                        <td class="overflow-wrap-break-word"> {{ $transaction->timezone }}</td>
                    </tr>
                    <tr>
                        <td>Payload</td>
                        <td class="overflow-wrap-break-word"> {{ $transaction->payload }}</td>
                    </tr>

                    <tr>
                        <td>Response</td>
                        <td class="overflow-wrap-break-word"> {{ $transaction->response }}</td>
                    </tr>
                </table>

            </section>



        </section>

        <section class="space-y-5">

            <div class="space-y-2 p-3 rounded-lg border dark:border-gray-500">
                <h2 class="font-semibold">Change Transaction Status</h2>

                <select class="form-control" wire:model="status">
                    <option value="">--Select Status--</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="space-y-2 p-3 rounded-lg border dark:border-gray-500">
                <h2 class="font-semibold">
                    <i class="las la-user"></i>
                    <span>Customer Information</span>
                </h2>

                <div class="flex items-center justify-start space-x-2">
                    <img src="{{ asset($transaction->user->profile_image) }}" alt="" class="w-[100px] h-[100px]" />
                    <ul class="text-xs space-y-2">
                        <li class="font-semibold">
                            <i class="las la-user"></i>

                            <a href="{{ route('admin.user.show', ['id' => $transaction->user->id]) }}">

                                <strong>{{ $transaction->user->fullname }}</strong><br />
                                <span>{{ $transaction->user->email }}</span>
                            </a>
                        </li>
                        {{-- <li class="font-semibold">
                            {{ $transaction->user->email }}
                        </li> --}}
                        {{-- <li>
                            <span class="font-semibold">{{ $transaction->user->orders->count() }}</span> Transactions
                        </li> --}}
                        {{-- <li class="font-light">
                            <i class="las la-phone"></i>
                            <a href="tel:{{ $transaction->user->mobile_number }}">{{ $transaction->user->mobile_number
                                }}</a>
                        </li>
                        <li class="font-light flex space-x-2 items-center">
                            <i class="las la-envelope"></i>
                            <a href="mailto:{{ $transaction->user->email }}">{{ $transaction->user->email }}</a>
                        </li> --}}
                    </ul>
                </div>
            </div>

        </section>



    </section>