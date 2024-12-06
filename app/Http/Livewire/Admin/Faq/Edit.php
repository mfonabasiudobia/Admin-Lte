<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Http\Livewire\BaseComponent;
use App\Repositories\FaqRepository;

class Edit extends BaseComponent
{

    public $question, $answer, $model;


    public function mount($id)
    {
        $this->model = FaqRepository::getById($id);

        $this->fill([
            'question' => $this->model->question,
            'answer' => $this->model->answer
        ]);
    }

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

            throw_unless(FaqRepository::update($data, $this->model->id), "Failed to update Faq");

            toast()->success('Faqs has been updated')->pushOnNextPage();

            return redirect()->route("admin.faq.list");
        } catch (\Exception $e) {

            return toast()->danger($e->getMessage())->push();
        }
    }



    public function render()
    {
        return view('livewire.admin.faq.edit')->layout('layouts.admin-base');
    }
}
