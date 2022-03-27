<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user')->id ?? null;

        return [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'photo' => 'image|file|max:2048',
        ];
    }

    public function update($user)
    {
        $user->update($this->all());
        $action = $user->links ? 'update' : 'create';
        $user->links()->$action([
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
        ]);
    }
}