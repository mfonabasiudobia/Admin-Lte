<section class="content-wrapper">
    <section class="flex justify-between items-center">
        <h1 class="title">Payment Method Configuration</h1>
    </section>

    <section class="grid grid-cols-2 gap-10">
         <form wire:submit.prevent="submitMsg91" class="space-y-5 border rounded-xl p-3">
                <h1 class="title">MSG91</h1>

                <p class="text-success">NB: Keep an OTP variable in your SMS providers OTP template</p>
                <section class="grid gap-5">

                    <div class="form-group">
                        <div>
                            <input type="radio" id="msg91_status_active" value="1" name="status" wire:model.defer="msg91_status" />
                            <label for="msg91_status_active">Active</label>
                        </div>    

                        <div>
                            <input type="radio" id="msg91_status_inactive" value="0" name="status" wire:model.defer="msg91_status" />
                            <label for="msg91_status_inactive">Inactive</label>
                        </div>    
                    </div>

                    <div class="form-group">
                        <label>Template ID</label>
                        <input type="text" class="form-control" placeholder="Template ID" wire:model.defer="msg91_template_id" />
                        @error('msg91_template_id') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>Auth Key</label>
                        <input type="text" class="form-control" placeholder="Auth Key" wire:model.defer="msg91_auth_key" />
                        @error('msg91_auth_key') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>

                <div class="form-group py-5 flex justify-end">
                    <x-atoms.loading-button text="Submit" target="submitMsg91" class="btn btn-lg btn-primary" />
                </div>
        </form>


    </section>

</section>