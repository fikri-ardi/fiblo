<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required|min:3|max:255', as: 'Nama')]
    public $name;

    #[Validate('required|min:3|max:255')]
    public $username;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('mimes:jpg,jpeg,bmp,png,svg|image|file|max:2048', as: 'Foto')]
    public $photo;

    #[Validate('min:3|max:2048')]
    public $bio;

    #[Validate('max:255')]
    public $instagram;

    #[Validate('max:255')]
    public $twitter;

    #[Validate('max:255')]
    public $facebook;
}
