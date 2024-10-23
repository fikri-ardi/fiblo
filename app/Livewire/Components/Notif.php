<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Psy\Command\HistoryCommand;

class Notif extends Component
{
    public $message;

    #[On('user-updated')]
    public function showNotif()
    {
        $this->message = "Berhasil update data kamu yaa 🫵";
    }

    public function render()
    {
        return view('livewire.components.notif', [
            "message" => $this->message
        ]);
    }
}
