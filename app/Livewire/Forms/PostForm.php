<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use App\Traits\ImageUpload;
use App\Traits\ValidateExcept;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;

class PostForm extends Form
{
    use ImageUpload;
    use ValidateExcept;

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

    public $excerpt;

    public $user_id;

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('posts')->ignore($this->post),
            ],
            'image' => ['image', 'file', 'max:2048'],
            'category_id' => ['required'],
            'body' => ['required'],
        ];
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;

        $this->fill(
            $post->only('title', 'slug', 'image', 'body', 'excerpt', 'category_id', 'user_id')
        );
    }

    public function store()
    {
        $this->validateExcept('image', $this->rules());

        $this->upload('image', 'post', 'images/posts');
        $this->excerpt = str()->limit(strip_tags($this->body), 160, '...');
        auth()->user()->posts()->create(
            $this->all()
        );
    }

    public function update()
    {
        Gate::authorize('update-post', $this->post);
        $this->validateExcept('image', $this->rules());

        $this->upload('image', 'post', 'images/posts');
        $this->excerpt = str()->limit(strip_tags($this->body), 160, '...');
        $this->post->update(
            $this->all()
        );
    }
}
