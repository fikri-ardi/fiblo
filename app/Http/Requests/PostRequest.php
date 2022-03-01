<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = $this->route('post')->id ?? null;

        return [
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:posts,slug,' . $id,
            'image' => 'image|file|max:2048',
            'category_id' => 'required',
            'body' => 'required',
        ];
    }
}