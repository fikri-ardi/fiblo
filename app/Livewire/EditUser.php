<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\UserForm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditUser extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->name = $user->name;
        $this->form->username = $user->username;
        $this->form->email = $user->email;
        $this->form->bio = $user->bio;
        $this->form->instagram = $user->links->instagram;
        $this->form->twitter = $user->links->twitter;
        $this->form->facebook = $user->links->facebook;
    }

    public function update()
    {
        Gate::authorize('update-user', auth()->user(), $this->user);

        // Jika user sudah upload foto
        if ($this->form->photo instanceof TemporaryUploadedFile) {
            // Jika user sebelumnya sudah mempunyai photo
            if ($this->user->photo) {
                // maka hapus foto lama mereka
                Storage::delete($this->user->photo);
            }
            // ganti dengan foto yang baru mereka upload
            $this->form->photo =  $this->form->photo->store(path: 'images/users');
        } else {
            // Jika user tidak memilih foto, maka gunakan foto lama mereka
            $this->form->photo = $this->user->photo;
        }

        $this->user->update(
            $this->form->all()
        );

        $this->dispatch('user-updated');
    }

    public function render()
    {
        $links = $this->user->links;

        return view('livewire.edit-user', compact('links'));
    }
}
