<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">Update Customer</h1>
    </section>

    <form wire:submit.prevent="submit" class="grid md:grid-cols-3 gap-5">

        <div class="form-group">
            <label>Fullname</label>
            <input type="text" class="form-control" placeholder="Fullname" wire:model.defer="fullname" />
            @error('fullname')
                <span class="error"> {{ $message }}</span>
            @endError
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" class="form-control" placeholder="Mobile Number" wire:model.defer="mobile_number" />
            @error('mobile_number')
                <span class="error"> {{ $message }}</span>
            @endError
        </div>


        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" placeholder="Email address" wire:model.defer="email" />
            @error('email')
                <span class="error"> {{ $message }}</span>
            @endError
        </div>



        <div class="form-group" x-data="{ show: false }">
            <label>Password</label>
            <input :type="show ? 'text' : 'password'" class="form-control" placeholder="Password"
                wire:model.defer="password" />
            @error('password')
                <span class="error"> {{ $message }}</span>
            @endError
            <button type='button' class="absolute bottom-3 right-3" x-on:click="show = !show">
                <i class="las" :class="!show ? 'la-eye' : 'la-eye-slash'"></i>
            </button>
        </div>

        <div class="form-group" x-data="{ show: false }">
            <label>Confirm Password</label>
            <input :type="show ? 'text' : 'password'" class="form-control" placeholder="Confirm Password"
                wire:model.defer="password_confirmation" />
            <button type='button' class="absolute bottom-3 right-3" x-on:click="show = !show">
                <i class="las" :class="!show ? 'la-eye' : 'la-eye-slash'"></i>
            </button>
        </div>



        <div class="form-group md:col-span-3 py-5 flex justify-end">
            <x-atoms.loading-button text="Update Customer" target="submit" class="btn btn-lg btn-primary" />
        </div>
    </form>

</section>
