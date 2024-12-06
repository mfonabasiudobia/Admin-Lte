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
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('header')

    @livewireStyles

</head>

<body>
    <section class="page-wrapper bg-light" x-data="{ toggleSidebar: true }">
        {{ $slot }}
    </section>



    @livewireScripts
    @toastScripts



    <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>

    <script defer src="{{ asset('js/js.js') }}?v={{ uniqid() }}"></script>


    @stack('script')

    <script src="{{ asset('js/a875a20b85.js') }}" crossorigin="anonymous"></script>
    <script src={{ asset('js/index.js') }}></script>
    <script>
        // JavaScript to toggle mobile menu visibility
      const menuBtn = document.getElementById("menu-btn");
      const mobileMenu = document.getElementById("mobile-menu");

      menuBtn.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
      });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>