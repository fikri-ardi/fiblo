<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['author', 'category'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($resource, array $filters)
    {
        // kembalikan resource(data post) yang title dan bodynya sesuai request('search') jika ada request('search') / user sedang melakukan searching 
        $resource->when($filters['search'] ?? false, function ($resource, $search) {
            return $resource->where('title', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        });

        $resource->when($filters['category'] ?? false, function ($resource, $category) {
            // kembalikan resource(data post) yang mempunyai category yang field slug di table categorynya = request('category')
            // kode dibawah mirip seperti $post->category->slug = request('category')
            return $resource->whereHas('category', function ($resource) use ($category) {
                $resource->where('slug', $category);
            });
        });

        $resource->when($filters['author'] ?? false, function ($resource, $author) {
            // kembalikan resource(data post) yang mempunyai author yang field username di table usernya = request('author')
            // kode dibawah mirip seperti $post->author->username = request('author')
            return $resource->whereHas('author', function ($resource) use ($author) {
                dd($resource->where('username', $author));
            });
        });
    }
}