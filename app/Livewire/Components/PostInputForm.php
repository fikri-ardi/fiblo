<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;

class PostInputForm extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public $categories;
    public $button;

    public function updated($property)
    {
        // Jika user sudah memilih file
        if ($property === 'form.image') {
            // Jika format file tidak sesuai dengan livewire config
            if (!in_array(strtolower($this->form->image->getClientOriginalExtension()), config('livewire.temporary_file_upload.preview_mimes'))) {
                // Maka ganti file yang dilipih user dengan filenya yang lama atau null
                $this->form->image = $this->post->image ?? null;
            }
        }

        // Jika title diubah
        if ($property === 'form.title') {
            // Maka ubah juga slug sesuai title
            $this->form->slug = strtolower(str_replace(' ', '-', $this->form->title));
        }
    }

    public function store(): void
    {
        $this->form->store();

        $this->redirectRoute('posts.show', $this->form->slug, navigate: true);
        $this->dispatch('post-created');
        session()->flash('message', 'Berhasil buat tulisan kamu 🫵');
    }

    public function render()
    {
        return view('livewire.components.post-input-form');
    }
}
