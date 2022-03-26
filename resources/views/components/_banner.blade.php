@if ($post->image)
<img src="{{ $post->image }}" class="card-img-top w-full h-full hero-image relative left-0 img-fluid object-cover object-center"
    alt="{{ $post->title }}">
@else
<img src="{{ asset('storage').'/images/posts/thumb.jpg' }}"
    class="card-img-top w-full h-full hero-image relative left-0 img-fluid object-cover object-center" alt="{{ $post->title }}">
@endif