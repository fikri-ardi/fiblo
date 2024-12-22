<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use App\Enums\PostStatus;
use Livewire\WithPagination;

class Explore extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::all();
        $posts = Post::postState(PostStatus::Published)
            ->filter(request(['search', 'category', 'author']))
            ->exclude(['body', 'updated_at'])
            ->latest()
            ->simplePaginate(7)
            ->withQueryString();

        // // Use unsplash API
        // // Configuration
        // \Unsplash\HttpClient::init([
        //     'applicationId'    => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
        //     'secret'    => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
        //     'callbackUrl'    => 'http://fiblo.test/',
        //     'utmSource' => 'Fiblo'
        // ]);

        // // Get some random photos
        // $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];
        $photos = env('DUMMY_IMAGE');

        return view('livewire.explore', compact('categories', 'posts', 'photos'));
    }
}
