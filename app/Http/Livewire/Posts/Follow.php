<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class Follow extends Component
{
    public $author;

    public function follow()
    {
        return auth()->user()->follow($this->author);
    }

    public function render()
    {
        return view('livewire.posts.follow');
    }
}
