@if ($post->image)
<img src="{{ config('app.url').$post->image }}" class="card-img-top w-full h-full relative left-0 object-cover object-center" alt="{{ $post->title }}">
@else
<img src="{{ $photos }}" class="card-img-top w-full h-full relative left-0 object-cover object-center" alt="{{ $post->title }}">
@endif