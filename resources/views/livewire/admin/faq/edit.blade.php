<section class="content-wrapper">
    <section class="flex justify-between items-center">
        <h1 class="title">Edit Faq</h1>
    </section>

    <form wire:submit.prevent="submit" class="space-y-5">
        <div class="form-group">
            <label>Question</label>
            <input type="text" class="form-control" placeholder="Question" wire:model.defer="question" />
            @error('question')
            <span class="error"> {{ $message }}</span>
            @endError
        </div>

        <div class="form-group">
            <label>Answer</label>
            <textarea class="form-control" placeholder="Answer" wire:model.defer="answer"></textarea>
            @error('answer')
            <span class="error"> {{ $message }}</span>
            @endError
        </div>


        <div class="form-group  flex justify-end">
            <x-atoms.loading-button text="Update" target="submit" class="btn btn-lg btn-primary" />
        </div>
    </form>

</section>