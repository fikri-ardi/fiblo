<?php

namespace App\Livewire\Profiles;

use Livewire\Attributes\On;
use Livewire\Component;

class Info extends Component
{
    public $postCount;
    public $user;

    /**
     * Ketika followers sudah diupdate oleh method follow yang ada di Following traits,
     * maka refresh component ini secara asynchronous.
     * 
     */
    protected $listeners = ['followersUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.profiles.info');
    }
}