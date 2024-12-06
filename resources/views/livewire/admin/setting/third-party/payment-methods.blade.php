<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">Payment Method Configuration</h1>
    </section>

    <section class="grid grid-cols-2 gap-10">
         <form wire:submit.prevent="submitRazor" class="space-y-5 border rounded-xl p-3">
                <h1 class="title">Razor Pay</h1>
                <section class="grid gap-5">

                    <div class="form-group">
                        <div>
                            <input type="radio" id="razor_status_active" value="1" name="status" wire:model.defer="razor_status" />
                            <label for="razor_status_active">Active</label>
                        </div>    

                        <div>
                            <input type="radio" id="razor_status_inactive" value="0" name="status" wire:model.defer="razor_status" />
                            <label for="razor_status_inactive">Inactive</label>
                        </div>    
                    </div>

                    <div class="form-group">
                        <label>Razor Key</label>
                        <input type="text" class="form-control" placeholder="Razor Key" wire:model.defer="razor_key" />
                        @error('razor_key') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>Razor Secret</label>
                        <input type="text" class="form-control" placeholder="Razor Secret" wire:model.defer="razor_secret" />
                        @error('razor_secret') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>
              
                <div class="form-group py-5 flex justify-end">
                    <x-atoms.loading-button text="Submit" target="submitRazor" class="btn btn-lg btn-primary" />
                </div>
        </form>




        <form wire:submit.prevent="submitPaypal" class="space-y-5 border rounded-xl p-3">
                <h1 class="title">Paypal</h1>
                <section class="grid gap-5">

                    <div class="form-group">
                        <div>
                            <input type="radio" id="paypal_status" value="1" name="status" wire:model.defer="paypal_status" />
                            <label for="paypal_status">Active</label>
                        </div>    

                        <div>
                            <input type="radio" id="paypal_status_inactive" value="0" name="status" wire:model.defer="paypal_status" />
                            <label for="paypal_status_inactive">Inactive</label>
                        </div>    
                    </div>

                    <div class="form-group">
                        <label>Paypal Client ID</label>
                        <input type="text" class="form-control" placeholder="Paypal Client ID" wire:model.defer="paypal_client_id" />
                        @error('paypal_client_id') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>Paypal Secret</label>
                        <input type="text" class="form-control" placeholder="Paypal Secret" wire:model.defer="paypal_secret" />
                        @error('paypal_secret') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>
              
                <div class="form-group py-5 flex justify-end">
                    <x-atoms.loading-button text="Submit" target="submitPaypal" class="btn btn-lg btn-primary" />
                </div>
        </form>



        <form wire:submit.prevent="submitStripe" class="space-y-5 border rounded-xl p-3">
                <h1 class="title">Stripe</h1>
                <section class="grid gap-5">

                    <div class="form-group">
                        <div>
                            <input type="radio" id="stripe_status" value="1" name="status" wire:model.defer="stripe_status" />
                            <label for="stripe_status">Active</label>
                        </div>    

                        <div>
                            <input type="radio" id="stripe_status_inactive" value="0" name="status" wire:model.defer="stripe_status" />
                            <label for="stripe_status_inactive">Inactive</label>
                        </div>    
                    </div>

                    <div class="form-group">
                        <label>Published Key</label>
                        <input type="text" class="form-control" placeholder="Published Key" wire:model.defer="stripe_published_key" />
                        @error('stripe_published_key') <span class="error"> {{ $message }}</span> @endError
                    </div>

                     <div class="form-group">
                        <label>API Key</label>
                        <input type="text" class="form-control" placeholder="API Key" wire:model.defer="stripe_api_key" />
                        @error('stripe_api_key') <span class="error"> {{ $message }}</span> @endError
                    </div>

                </section>
              
               <div class="form-group py-5 flex justify-end">
                <x-atoms.loading-button text="Submit" target="submitStripe" class="btn btn-lg btn-primary" />
            </div>
        </form>
    </section>

</section>