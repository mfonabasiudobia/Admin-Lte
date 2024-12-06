<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex" />
    @stack('meta_data')

    <link rel="shortcut icon" href="{{ asset('storage/images/logo/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link rel="preload" as="style" href="{{ asset('build/assets/app-572dd61a.css') }}" />
    <link rel="modulepreload" href="{{ asset('build/assets/app-02317797.js') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-572dd61a.css') }}" />
    <script type="module" src="{{ asset('build/assets/app-02317797.js') }}"></script> --}}
    <!-- Livewire Styles -->

    @stack('header')

    @livewireStyles

</head>

<body>
    <livewire:toasts />
    <section class="page-wrapper bg-light" x-data="{ toggleSidebar: true }">
        <section class="flex">
            @if (!AppHelper::isAdminAuthRoute())
                @livewire('admin.partials.sidebar')
            @endIf
            <div class="overflow-y-auto w-full min-h-screen">
                @if (!AppHelper::isAdminAuthRoute())
                    @livewire('admin.partials.header')
                @endIf
                <div class="p-3 md:p-5">
                    {{ $slot }}
                </div>
            </div>
        </section>
    </section>


    @livewireScripts
    @toastScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/srfq9lugj6h3um0oumk0latm9rs1cx0zyrcojwh2rc7van3r/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <script defer src="{{ asset('js/js.js') }}?v={{ uniqid() }}"></script>


    @stack('script')

</body>

</html>
