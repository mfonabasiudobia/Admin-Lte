<section class="space-y-5">
    <section class="content-wrapper">
        <x-loading />

        <section class="flex justify-between items-center">
            <h1 class="title">Active Employees</h1>

            <a href="{{ route('admin.employee.create') }}" class="bg-primary action-btn">Add New Employee</a>
        </section>
        @livewire('admin.employee.tables.home', key($key))
    </section>


    <section class="content-wrapper">
        <section class="flex justify-between items-center">
            <h1 class="title">Deleted Employees</h1>
        </section>
        @livewire('admin.employee.tables.home', ['is_deleted' => true], key($key . '-deleted'))
    </section>
</section>
