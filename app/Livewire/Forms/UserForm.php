<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Traits\ImageUpload;
use App\Traits\ValidateExcept;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class UserForm extends Form
{
    use ImageUpload;
    use ValidateExcept;

    public ?User $user;

    #[Validate]
    public $name;

    #[Validate]
    public $username;

    #[Validate]
    public $email;

    #[Validate]
    public $photo;

    #[Validate]
    public $bio;

    #[Validate]
    public $instagram;

    #[Validate]
    public $twitter;

    #[Validate]
    public $facebook;

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'username' => [
                'required',
                'alpha_dash',
                'min:3',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'photo' => ['mimes: jpg,jpeg,bmp,png,svg', 'image', 'file', 'max: 2048'],
            'bio' => ['max: 255'],
            'instagram' => ['max: 255'],
            'twitter' => ['max: 255'],
            'facebook' => ['max: 255'],
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->fill(
            $user->only('name', 'username', 'email', 'bio')
        );

        $this->instagram = $user->links->instagram;
        $this->twitter = $user->links->twitter;
        $this->facebook = $user->links->facebook;
    }

    public function update()
    {
        $this->validateExcept('photo', $this->rules());
        Gate::authorize('update-user', auth()->user(), $this->user);

        $this->upload('photo', 'user', 'images/users');
        $this->user->update(
            $this->all()
        );
    }
}
