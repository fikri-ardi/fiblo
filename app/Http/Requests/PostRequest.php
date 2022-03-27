<?php

namespace App\Http\Requests;

use App\Models\Post;
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

    public function updateOrInsert($post = null)
    {
        $this['excerpt'] = str()->limit(strip_tags($this->body), 160, '...');
        $this['user_id'] = auth()->id();
        $this['status'] = 'published';

        $post ? $post->update($this->all()) : Post::create($this->all());
    }
}