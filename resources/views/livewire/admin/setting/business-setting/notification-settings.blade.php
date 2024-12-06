<section class="content-wrapper">
    <section class="flex justify-between items-center">
        <h1 class="title">App Configuration</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">

                <section class="grid md:grid-cols-2 gap-5">

                    <div class="form-group">
                        <label>Server Key</label>
                        <input type="text" class="form-control" placeholder="Server Key" wire:model.defer="server_key" />
                        @error('server_key') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>FCM Project ID</label>
                        <input type="text" class="form-control" placeholder="FCM Project ID" wire:model.defer="fcm_project_id" />
                        @error('fcm_project_id') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>

                <div class="form-group py-5 flex justify-end">
                    <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
                </div>
   </form>

</section>