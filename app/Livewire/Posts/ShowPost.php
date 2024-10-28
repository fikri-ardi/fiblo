<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;
    public $photos;


    public function mount(Post $post)
    {
        $this->post = $post;
        $this->photos = env('DUMMY_IMAGE');
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
