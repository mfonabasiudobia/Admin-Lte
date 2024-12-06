<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">Add Permissions</h1>
    </section>

    <form wire:submit.prevent="submit" class="grid md:grid-cols-3 gap-5">

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Name" wire:model.defer="name" />
            @error('name') <span class="error"> {{ $message }}</span> @endError
        </div>


        <div class="form-group md:col-span-3 py-5 flex justify-end">
            <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary btn-rounded" />
        </div>
    </form>

</section>