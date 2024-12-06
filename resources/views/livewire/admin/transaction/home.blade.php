<section class="content-wrapper">
    <x-loading />

    <section class="flex justify-between items-center">
        <h1 class="title"><span class="capitalize">{{ str()->replace('_', ' ', $status) }}</span> Transactions</h1>
    </section>
    @livewire('admin.transaction.tables.home', ['status' => $this->status, 'remark' => $remark ], key($key))
</section>
