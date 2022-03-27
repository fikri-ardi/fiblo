@if ($post->image)
<img src="{{ $post->image }}" class="card-img-top w-full h-full relative left-0 object-cover object-center" alt="{{ $post->title }}">
@else
<img src="{{ asset('storage').'/images/posts/thumb.jpg' }}" class="card-img-top w-full h-full relative left-0 object-cover object-center"
    alt="{{ $post->title }}">
@endif