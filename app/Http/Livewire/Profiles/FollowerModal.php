<?php

namespace App\Http\Livewire\Profiles;

use Livewire\Component;

class FollowerModal extends Component
{
    public $user;
    public $type;

    /**
     * Ketika followers sudah diupdate oleh method follow yang ada di Following traits,
     * maka refresh component ini secara asynchronous.
     * 
     */
    protected $listeners = ['followersUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.profiles.follower-modal');
    }
}
