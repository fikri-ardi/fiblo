<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $photos;
    public $posts;

    public function render()
    {
        return view('livewire.components.posts');
    }
}
