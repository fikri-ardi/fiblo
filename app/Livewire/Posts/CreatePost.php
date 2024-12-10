<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\PostForm;
use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public Post $post;
    public $categories;

    public function mount(Post $post)
    {
        $this->form->setPost($post);
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
