<?php

namespace App\Http\Livewire\Admin\Gallery\Modal;

use Livewire\Component;
use App\Http\Traits\Filterable;
use App\Models\Gallery;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use AppHelper;

class Create extends Component
{

    public $image, $show = false, $uniqueid;
    use Filterable, WithFileUploads, WithPagination;

    protected $listeners = ['openGallery']; 


    public function openGallery($detail = null){
        $this->show = true;
        $this->dispatchBrowserEvent('trigger-file-modal');
        $this->uniqueid = $detail;
    }

    public function removeFile(){
        $this->reset(['image']);
    }

    public function uploadImage(){

            $this->validate(["image" => "required|mimes:jpeg,png,jpg,webp,svg"]);


            Gallery::create([
                'file_path' => AppHelper::uploadFile($this->image, 'images/files')
            ]);


            toast()->success("File has been uploaded")->push();

            $this->reset(['image']);
            $this->show = true;

      }


    public function render()
    {

        $files = $this->sort(Gallery::query())->paginate(20);

        return view('livewire.admin.gallery.modal.create', ['files' => $files]);
    }
}
