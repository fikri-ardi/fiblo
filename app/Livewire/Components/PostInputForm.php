<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\PostForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostInputForm extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public $categories;

    public function updated($property)
    {
        // Jika user sudah memilih file
        if ($property === 'form.image') {
            // Jika format file tidak sesuai dengan livewire config
            if (!in_array(strtolower($this->form->image->getClientOriginalExtension()), config('livewire.temporary_file_upload.preview_mimes'))) {
                // Maka ganti file yang dilipih user dengan filenya yang lama
                $this->form->image = null;
            }
        }
    }

    public function store()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.components.post-input-form');
    }
}
