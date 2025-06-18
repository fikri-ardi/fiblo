<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;
use Illuminate\Support\Facades\Route;

class PostInputForm extends Component
{
    use WithFileUploads;

    public ?Post $post;
    public PostForm $form;
    public $categories;
    public $action;
    public $button;

    // When post form is being updated
    public function updating()
    {
        $this->dispatch('updating-post');
    }

    // When post form is updated
    public function updated($name, $value)
    {
        // Real-time form saving
        if (isset($this->post)) {
            $this->post->update([
                str_replace('form.', '', $name) => $value,
                'form.excerpt' => str()->limit(strip_tags($this->form->body), 160, '...'),
            ]);
        }

        // Jika user sudah memilih file
        if ($name === 'form.image') {
            // Jika format file tidak sesuai dengan livewire config
            if (!in_array(strtolower($this->form->image->getClientOriginalExtension()), config('livewire.temporary_file_upload.preview_mimes'))) {
                // Maka ganti file yang dilipih user dengan filenya yang lama atau null
                $this->form->image = $this->post->image ?? null;
            }
        }

        // Jika title diubah
        if ($name === 'form.title') {
            // Maka ubah juga slug sesuai title
            $this->form->slug = strtolower(str_replace(' ', '-', $this->form->title));
        }
    }

    public function store()
    {
        $this->form->store();

        $this->redirectRoute('posts.show', $this->form->slug, navigate: true);
        $this->dispatch('post-created');
        session()->flash('message', 'Berhasil buat tulisan kamu 🫵');
    }

    public function update()
    {
        $this->form->update();

        $this->redirectRoute('posts.show', $this->form->slug, navigate: true);
        $this->dispatch('post-updated');
        session()->flash('message', 'Berhasil edit tulisan kamu 🫵');
    }

    public function render()
    {
        return view('livewire.components.post-input-form');
    }
}