<?php

namespace App\Livewire\Components;

use App\Models\Post as PostModel;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $photos;

    public function delete()
    {
        PostModel::destroy($this->post->id);

        $this->dispatch('post-deleted');
        session()->flash('message', 'Berhasil hapus post kamu ya 😊');
    }

    public function render()
    {
        return view('livewire.components.post');
    }
}
