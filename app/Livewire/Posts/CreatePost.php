<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\PostForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function store()
    {
        //
    }

    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
