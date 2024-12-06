<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">App Configuration</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">

        <section class="grid  md:grid-cols-2 gap-5">
            <div class="form-group">
                <label>Personal Card Limit</label>

                <select wire:model.defer='personal_card_limit' class="form-control">
                    <option value="unlimited">Unlimited</option>
                    @foreach (range(1, 50) as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('personal_card_limit')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Sport Card Limit</label>

                <select wire:model.defer='sport_card_limit' class="form-control">
                    <option value="unlimited">Unlimited</option>
                    @foreach (range(1, 50) as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('sport_card_limit')
                <span class="error"> {{ $message }}</span>
                @endError
            </div>
        </section>



        <div class="form-group" wire:ignore>
            <label>Payment Notes</label>
            <x-text-editor model="payment_note" />
            @error('payment_note') <span class="error"> {{ $message }}</span> @endError
        </div>




        <div class="form-group py-5 flex justify-end">
            <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
        </div>
    </form>

</section>
