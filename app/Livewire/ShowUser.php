<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\PostStatus;
use App\Models\User;

class ShowUser extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $posts = $this->user->posts()->postState(PostStatus::Published)->latest()->paginate(6);
        $photos = env('DUMMY_IMAGE');

        return view('livewire.show-user', compact('posts', 'photos'));
    }
}