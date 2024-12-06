<div class="space-y-5">

    @livewire('admin.role.create')
    
    <section class="content-wrapper">
    <x-loading />

    <section class="flex justify-between items-center">
        <h1 class="title">Roles</h1>

        {{-- <a href="{{ route('admin.role.create') }}" class="bg-primary action-btn">Add New Role</a> --}}
    </section>
    @livewire('admin.role.tables.home', key($key))
</section>

</div>