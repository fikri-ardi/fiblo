<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate]
    public $title;

    #[Validate]
    public $slug;

    #[Validate]
    public $image;

    #[Validate]
    public $category_id;

    #[Validate]
    public $body;

    public function __construct()
    {
        dd($this);
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($this->post),
            ],
            'image' => ['image', 'file', 'max:2048'],
            'category_id' => ['required'],
            'body' => ['required'],
        ];
    }
}
