<?php

namespace App\Http\Livewire;

use App\Http\Requests\ProductStoreRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;
    public $image;


    public function upload()
    {   
    }

    public function render()
    {
        
        return view('livewire.image-upload');
    }
}
