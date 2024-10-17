<?php

namespace App\Livewire\Profiles;

use Livewire\Component;

class Follow extends Component
{
    public $targetUser;

    public function follow()
    {
        auth()->user()->follow($this->targetUser);
        $this->dispatch('followersUpdated', $this->targetUser->username); //will be heard by profiles.info livewire component
    }

    public function render()
    {
        return view('livewire.profiles.follow');
    }
}