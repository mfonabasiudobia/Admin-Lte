<section class="space-y-5">
    <x-loading />
    @if(in_array($remark, ['ACTIVE']))
    <section class="content-wrapper">
        <section class="flex justify-between items-center">
            <h1 class="title">{{ $remark }} Customers</h1>

            {{-- <a href="{{ route('admin.user.create') }}" class="bg-primary action-btn">Add New Customers</a> --}}
        </section>


        @livewire('admin.user.tables.home', key($key))
    </section>
    @endIf


    @if(in_array($remark, ['INACTIVE']))
    <section class="content-wrapper">
        <section class="flex justify-between items-center">
            <h1 class="title">{{ $remark }} Customers</h1>

            {{-- <a href="{{ route('admin.user.create') }}" class="bg-primary action-btn">Add New Customers</a> --}}
        </section>
        @livewire('admin.user.tables.home', ['is_deleted' => true], key($key . 'deleted'))
    </section>
    @endIf


    @if(in_array($remark, ['BLOCKED']))
    <section class="content-wrapper">
        <section class="flex justify-between items-center">
            <h1 class="title">{{ $remark }} Customers</h1>

            {{-- <a href="{{ route('admin.user.create') }}" class="bg-primary action-btn">Add New Customers</a> --}}
        </section>
        @livewire('admin.user.tables.home', ['blocked' => true], key($key . 'deleted'))
    </section>
    @endIf

</section>
