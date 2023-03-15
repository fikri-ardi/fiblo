@if ($post->image)
<img src="{{ $post->image }}" class="card-img-top w-full h-full relative left-0 object-cover object-center" alt="{{ $post->title }}">
@else
<img src="https://source.unsplash.com/1600x900/?{{ $post->category->name }}"
    class="card-img-top w-full h-full relative left-0 object-cover object-center" alt="{{ $post->title }}">
@endif