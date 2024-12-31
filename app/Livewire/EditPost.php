<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;

class EditPost extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public ?Post $post;
    public $categories;

    public function mount(Post $post)
    {
        $this->form->setPost($post);
        $this->categories = Category::all();
    }

    public function updated($name, $value)
    {
        $this->post->update([
            $name => $value
        ]);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
