<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">Update Role</h1>
    </section>

    <form wire:submit.prevent="submit" class="grid  gap-5">

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Name" wire:model.defer="name" />
            @error('name') <span class="error"> {{ $message }}</span> @endError
        </div>

        <div class="form-group">
            <label>Permissions</label>
            <div class="grid grid-cols-2 md:grid-cols-3">
        
                <div>
                    <input type="checkbox" value="all" id="all" wire:model="all" />
                    <label for="all">All</label>
                </div>
        
                @foreach ($permissions as $permission)
                <div>
                    <input type="checkbox" name="permission" value="{{ $permission->id }}"
                        wire:model.defer="selectedPermissions" id="permission{{ $permission->id }}" />
                    <label for="permission{{ $permission->id }}" class="capitalize">{{ str()->replace('_', ' ', $permission->name) }}</label>
                </div>
                @endforeach
            </div>
            @error('selectedPermissions') <span class="error"> {{ $message }}</span> @endError
        </div>


        <div class="form-group  py-5 flex justify-end">
            <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary btn-rounded" />
        </div>
    </form>

</section>