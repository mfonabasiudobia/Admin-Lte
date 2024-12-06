<section class="bg-white text-gray-800  top-0 inset-x-0 z-30">
    <nav class="p-4 max-w-screen-2xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="logo flex items-center">
            <div class="px-4">
                <img src="{{ asset(gs()->logo) }}" alt="" class="w-16 h-16">
            </div>
            <!-- Links -->
            <div class="nav-links hidden md:flex justify-between items-center gap-x-4 p-2">
                <ul class="flex justify-between gap-x-5 font-sans leading-normal text-gray-800 text-sm">
                    <li class="font-bold">
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#feature">Features</a>
                    </li>
                    <li><a href="#how-it-works">How it works</a></li>
                    <li><a href="#faqs">FAQs</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <!-- Mobile menu button -->
        <button id="menu-btn" class="block md:hidden p-2 focus:outline-none">
            <i class="fas fa-bars fa-lg"></i>
            <!-- Menu icon -->
            <!-- <i class="fas fa-times fa-lg"></i> -->
        </button>
        <!-- Buttons -->
        <div class="download-btn hidden md:flex justify-between items-center gap-x-2 text-secondary">
            <a href="#">
                <img src="/images/google-play.svg" alt="" class="w-28 h-auto" />
            </a>

            <a href="#">
                <img src="/images/apple-store.svg" alt="" class="w-28 h-auto" />
            </a>
        </div>
    </nav>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden px-6 mb-4">
        <ul class="bg-white flex flex-col gap-y-4">
            <li class="shadow-sm">Home</li>
            <li class="shadow-sm">Features</li>
            <li class="shadow-sm">How it works</li>
            <li class="shadow-sm">FAQs</li>
            <li class="shadow-sm">Contact Us</li>
        </ul>
    </div>
</section>