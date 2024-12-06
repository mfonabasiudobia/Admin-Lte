<section class="content-wrapper">

    <section class="flex justify-between items-center">
        <h1 class="title">App Configuration</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">

        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Airtime Transaction Messages
            </div>

            <div class="form-group">
                <label>Airtime Success Title</label>
                <input type="text" class="form-control" placeholder="Airtime Success Title"
                    wire:model.defer="airtime_success_title" />
                @error('airtime_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Airtime Success Description</label>
                <textarea class="form-control" placeholder="Airtime Success Description" wire:model.defer="airtime_success_description"></textarea>
                @error('airtime_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>



        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Electricity Transaction Messages
            </div>

            <div class="form-group">
                <label>Electricity Success Title</label>
                <input type="text" class="form-control" placeholder="Electricity Success Title"
                    wire:model.defer="electricity_success_title" />
                @error('electricity_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Electricity Success Description</label>
                <textarea class="form-control" placeholder="Electricity Success Description"
                    wire:model.defer="electricity_success_description"></textarea>
                @error('electricity_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>



        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Cable TV Transaction Messages
            </div>

            <div class="form-group">
                <label>Cable TV Success Title</label>
                <input type="text" class="form-control" placeholder="Cable TV Success Title"
                    wire:model.defer="cable_tv_success_title" />
                @error('cable_tv_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Cable TV Success Description</label>
                <textarea class="form-control" placeholder="Cable TV Success Description"
                    wire:model.defer="cable_tv_success_description"></textarea>
                @error('cable_tv_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>


        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Data Transaction Messages
            </div>

            <div class="form-group">
                <label>Data Success Title</label>
                <input type="text" class="form-control" placeholder="Data Success Title"
                    wire:model.defer="data_success_title" />
                @error('data_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Data Success Description</label>
                <textarea class="form-control" placeholder="Data Success Description" wire:model.defer="data_success_description"></textarea>
                @error('data_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>



        <section class="grid gap-5 p-5 border rounded-md">
            <div>
                Airtime Swap Transaction Messages
            </div>

            <div class="form-group">
                <label>Airtime Swap Success Title</label>
                <input type="text" class="form-control" placeholder="Airtime Swap Success Title"
                    wire:model.defer="airtime_swap_success_title" />
                @error('airtime_swap_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Airtime Swap Success Description</label>
                <textarea class="form-control" placeholder="Airtime Swap Success Description"
                    wire:model.defer="airtime_swap_success_description"></textarea>
                @error('airtime_swap_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Airtime Swap Guide</label>
                <x-text-editor model="airtime_swap_guide" placeholder="Airtime Swap Guide" />
                @error('airtime_swap_guide')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>


        </section>



        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Betting Transaction Messages
            </div>

            <div class="form-group">
                <label>Betting Success Title</label>
                <input type="text" class="form-control" placeholder="Betting Success Title"
                    wire:model.defer="betting_success_title" />
                @error('betting_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Betting Success Description</label>
                <textarea class="form-control" placeholder="Betting Success Description" wire:model.defer="betting_success_description"></textarea>
                @error('betting_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>


        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Movie Ticket Transaction Messages
            </div>

            <div class="form-group">
                <label>Movie Ticket Success Title</label>
                <input type="text" class="form-control" placeholder="Movie Ticket Success Title"
                    wire:model.defer="movie_ticket_success_title" />
                @error('movie_ticket_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Movie Ticket Success Description</label>
                <textarea class="form-control" placeholder="Movie Ticket Success Description"
                    wire:model.defer="movie_ticket_success_description"></textarea>
                @error('movie_ticket_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>


        <section class="grid gap-5 p-5 border rounded-md">

            <div>
                Gift Card Transaction Messages
            </div>

            <div class="form-group">
                <label>Gift Card Success Title</label>
                <input type="text" class="form-control" placeholder="Gift Card Success Title"
                    wire:model.defer="gift_card_success_title" />
                @error('gift_card_success_title')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

            <div class="form-group">
                <label>Gift Card Success Description</label>
                <textarea class="form-control" placeholder="Gift Card Success Description"
                    wire:model.defer="gift_card_success_description"></textarea>
                @error('gift_card_success_description')
                    <span class="error"> {{ $message }}</span>
                @endError
            </div>

        </section>








        <div class="form-group py-5 flex justify-end">
            <x-atoms.loading-button text="Submit" target="submit" class="btn btn-lg btn-primary" />
        </div>
    </form>

</section>
