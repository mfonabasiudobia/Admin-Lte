<section class="content-wrapper">
    @livewire("admin.gallery.modal.create")
    <section class="flex justify-between items-center">
        <h1 class="title">Business Details</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">

                <section class="grid md:grid-cols-2 gap-5">

                    <div class="form-group md:col-span-2" x-data="{ logo : @entangle('logo').defer }"
                        @set-push-file.window="if($event.detail.unique_key == 'logo') logo = $event.detail.path;">
                        <label>logo</label>
                        <input type="file" class="form-control" placeholder="Upload logo"
                            x-on:click.prevent="$wire.emit('openGallery', 'logo')" />
                    
                        <img x-bind:src="'{{ url('/') }}/' + logo" x-show="logo ? true : false" class="image-preview" x-cloak />
                    
                        @error('logo') <span class="error"> {{ $message }}</span> @endError
                    </div>


                    <div class="form-group">
                        <label>Business Name</label>
                        <input type="text" class="form-control" placeholder="Name" wire:model.defer="name" />
                        @error('name') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="Email address" wire:model.defer="email" />
                        @error('email') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>

                <section class="grid md:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone number" wire:model.defer="phone_number" />
                        @error('phone_number') <span class="error"> {{ $message }}</span> @endError
                    </div>

                      <div class="form-group">
                        <label>Business Address</label>
                        <input type="text" class="form-control" placeholder="Address" wire:model.defer="address" />
                        @error('address') <span class="error"> {{ $message }}</span> @endError
                    </div>
                    
                </section>


              
               <div class="form-group py-5 flex justify-end">
                <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
            </div>
   </form>

</section>