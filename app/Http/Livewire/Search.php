<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $users;
    public $posts;

    public function updating()
    {
        $this->users = User::where('name', 'like', "%$this->search%")
            ->orWhere('username', 'like', "%$this->search%")
            ->limit(3)->get();

        $this->posts = Post::where('title', 'like', "%$this->search%")
            ->orWhere('body', 'like', "%$this->search%")
            ->limit(3)->get();
    }

    public function render()
    {
        return view('livewire.search', [
            'users' => $this->users,
            'posts' => $this->posts,
        ]);
    }
}
