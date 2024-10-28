<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use App\Enums\PostStatus;

class AllPosts extends Component
{
    public function render()
    {
        $posts = Post::postState(PostStatus::Published)
            ->filter(request(['search', 'category', 'author']))
            ->exclude(['body', 'updated_at'])
            ->latest()
            ->paginate(7)
            ->withQueryString();
        $photos = env('DUMMY_IMAGE');

        return view('livewire.posts.all-posts', compact('posts', 'photos'));
    }
}
