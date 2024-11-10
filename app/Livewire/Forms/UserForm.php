<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class UserForm extends Form
{
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
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->instagram = $user->links->instagram;
        $this->twitter = $user->links->twitter;
        $this->facebook = $user->links->facebook;
    }

    public function validateExcept($property): array
    {
        // Remove 'photo' validation rule
        $filteredRules = array_diff_key($this->rules(), [$property => '']);

        // Validate the remaining fields
        return $this->validate($filteredRules);
    }

    public function updatePhoto(): void
    {
        // Jika user sudah upload foto
        if ($this->photo instanceof TemporaryUploadedFile) {
            // Jika user sebelumnya sudah mempunyai photo
            if ($this->user->photo) {
                // maka hapus foto lama mereka
                Storage::delete($this->user->photo);
            }
            // ganti dengan foto yang baru mereka upload
            $this->photo =  $this->photo->store(path: 'images/users');
        } else {
            // Jika user tidak memilih foto, maka gunakan foto lama mereka
            $this->photo = $this->user->photo;
        }
    }

    public function update()
    {
        $this->validateExcept('photo');
        Gate::authorize('update-user', auth()->user(), $this->user);

        $this->updatePhoto();
        $this->user->update(
            $this->all()
        );
    }
}
