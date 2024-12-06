
<div class="space-y-5">

    @livewire('admin.permission.create')
    <section class="content-wrapper">
        <x-loading />
    
        <section class="flex justify-between items-center">
            <h1 class="title">Permission</h1>
    
            {{-- <a href="{{ route('admin.permission.create') }}" class="bg-primary action-btn">Add New Permission</a> --}}
        </section>
        @livewire('admin.permission.tables.home', key($key))
    </section>

</div>