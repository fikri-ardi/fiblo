<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = $this->route('role')->id ?? null;

        return [
            'name' => 'required|unique:roles,name,' . $id
        ];
    }

    public function insertOrUpdate($role = null)
    {
        $this['slug'] = str()->slug($this->name);
        $role ? $role->update($this->all()) : Role::create($this->all());
    }
}