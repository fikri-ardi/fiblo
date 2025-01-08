<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;
    public $photos;
    public $reading_time;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->photos = env('DUMMY_IMAGE');
        $this->reading_time = ceil(str($post->body)->wordCount() / 200);
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
