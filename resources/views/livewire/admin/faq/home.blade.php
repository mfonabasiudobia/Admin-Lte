<section class="content-wrapper">
    <x-loading />

    <section class="flex justify-between items-center">
        <h1 class="title">Faqs</h1>

        <a href="{{ route('admin.faq.create') }}" class="bg-primary action-btn">Add Faqs</a>
    </section>
    @livewire('admin.faq.tables.home', key($key))
</section>