<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $photos;

    public function render()
    {
        return view('livewire.components.posts');
    }
}
