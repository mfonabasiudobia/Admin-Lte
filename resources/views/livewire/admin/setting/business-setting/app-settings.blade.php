<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">App Configuration</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">

        <section class="grid md:grid-cols-2 gap-5">

            <div class="form-group">
                <label>App Minimum Version Android</label>
                <input type="text" class="form-control" placeholder="App Minimum Version Android"
                    wire:model.defer="app_minimum_version_android" />
                @error('app_minimum_version_android')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>App Minimum Version IOS</label>
                <input type="text" class="form-control" placeholder="App Minimum Version IOS"
                    wire:model.defer="app_minimum_version_ios" />
                @error('app_minimum_version_ios')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>APP URL Android</label>
                <input type="text" class="form-control" placeholder="APP URL Android"
                    wire:model.defer="app_url_android" />
                @error('app_url_android')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>APP URL IOS</label>
                <input type="text" class="form-control" placeholder="APP URL IOS" wire:model.defer="app_url_ios" />
                @error('app_url_ios')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>


            <div class="form-group">
                <label>Live Chat URL</label>
                <input type="text" class="form-control" placeholder="Live Chat URL" wire:model.defer="live_chat_url" />
                @error('live_chat_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Terms and Condition URL</label>
                <input type="text" class="form-control" placeholder="Terms and Condition URL"
                    wire:model.defer="terms_and_condition_url" />
                @error('terms_and_condition_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Privacy Policy URL</label>
                <input type="text" class="form-control" placeholder="Privacy Policy URL"
                    wire:model.defer="privacy_policy_url" />
                @error('privacy_policy_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>About US URL</label>
                <input type="text" class="form-control" placeholder="About US URL" wire:model.defer="about_us_url" />
                @error('about_us_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Help and Support URL</label>
                <input type="text" class="form-control" placeholder="Help and Support URL"
                    wire:model.defer="help_and_support_url" />
                @error('help_and_support_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Facebook URL</label>
                <input type="text" class="form-control" placeholder="Facebook URL" wire:model.defer="facebook_url" />
                @error('facebook_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Twitter URL</label>
                <input type="text" class="form-control" placeholder="Twitter URL" wire:model.defer="twitter_url" />
                @error('twitter_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Linkedin URL</label>
                <input type="text" class="form-control" placeholder="Linkedin URL" wire:model.defer="linkedin_url" />
                @error('linkedin_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>


        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Whatsapp URL</label>
                <input type="text" class="form-control" placeholder="Whatsapp URL" wire:model.defer="whatsapp_url" />
                @error('whatsapp_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Instagram URL</label>
                <input type="text" class="form-control" placeholder="Instagram URL" wire:model.defer="instagram_url" />
                @error('instagram_url')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>

        <div class="form-group py-5 flex justify-end">
            <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
        </div>
    </form>

</section>
