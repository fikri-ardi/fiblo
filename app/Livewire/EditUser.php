<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\UserForm;

class EditUser extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public User $user;

    /**
     * Called after updated property
     * 
     */
    public function updated($property)
    {
        // Jika user sudah memilih file
        if ($property === 'form.photo') {
            // Jika format file tidak sesuai dengan livewire config
            if (!in_array(strtolower($this->form->photo->getClientOriginalExtension()), config('livewire.temporary_file_upload.preview_mimes'))) {
                // Maka ganti file yang dilipih user dengan filenya yang lama
                $this->form->photo = $this->user->photo;
            }
        }
    }

    public function mount(User $user)
    {
        $this->form->setUser($user);
    }

    public function update()
    {
        $this->form->update();

        $this->redirectRoute('users.show', $this->form->username, navigate: true);
        $this->dispatch('user-updated');
        session()->flash('message', 'Berhasil update data kamu yaa 🫵');
    }

    public function render()
    {
        $links = $this->user->links;

        return view('livewire.edit-user', compact('links'));
    }
}
