<section class="min-h-screen flex flex-col space-y-3 items-center justify-center">
    {{--
    <x-loading /> --}}

    <div class="flex justify-center py-3">
        <a href="{{route('admin.dashboard')}}">
            {{-- <img src="{{asset(cache('setting')->logo)}}" class="w-[100px] h-auto" /> --}}
        </a>
    </div>

    <section class="bg-white dark:bg-dark dark:text-white border dark:border-gray-500 md:w-1/2 lg:w-1/3 p-5 space-y-5">
        <h1 class="text-xl text-center font-light">Login To Admin Dashboard</h1>

        <form wire:submit.prevent="submit" class="space-y-5">

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email Address" wire:model.defer="email" />
            </div>

            <div class="form-group" x-data="{ show : false}">
                <input :type="show ? 'text' : 'password'" class="form-control" placeholder="Password"
                    wire:model.defer="password" />
                <button type='button' class="absolute top-3 right-3" x-on:click="show = !show">
                    <i class="las" :class="!show ? 'la-eye' : 'la-eye-slash'"></i>
                </button>
            </div>

            <div class="form-group flex items-center justify-start text-sm space-x-2">
                <input type="checkbox" wire:model.defer="rm" class="w-3 h-3 accent-primary" id='rm' />
                <label for='rm'>Remember me</label>
            </div>

            <div class="form-group">
                <x-atoms.loading-button text="LOGIN" target="submit" class="btn btn-lg btn-primary btn-block" />
            </div>

    </section>

    </form>


</section>
</section>