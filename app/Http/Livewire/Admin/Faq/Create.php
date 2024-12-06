<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Http\Livewire\BaseComponent;
use App\Repositories\FaqRepository;

class Create extends BaseComponent
{

    public $question, $answer;


    public function submit()
    {

        $this->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);


        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
        ];

        try {

            throw_unless(FaqRepository::create($data), "Failed to create Faq");

            toast()->success('Faqs has been created')->pushOnNextPage();

            return redirect()->route("admin.faq.list");
        } catch (\Exception $e) {

            return toast()->danger($e->getMessage())->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.faq.create')->layout('layouts.admin-base');
    }
}
