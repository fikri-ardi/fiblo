<?php

namespace App\Livewire;

use Livewire\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $model;
    public $label;

    public function render()
    {
        return view('livewire.input');
    }
}
