<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|alpha_dash|min:3|max:255|unique:users,username,' . $id,
            'email' => 'required|email:dns|max:255|unique:users,email,' . $id,
            'role_id' => 'required',
        ];
    }

    public function inserOrUpdate($user = null)
    {
        if ($user) {
            $user->update($this->all());
        } else {
            $this['password'] = 'password';
            User::create($this->all());
        }
    }
}