@if ($post->image)
<img src="/storage/{{ $post->image }}" class="card-img-top w-full h-full hero-image position-relative left-0 img-fluid object-cover max-h-96"
    alt="{{ $post->title }}">
@else
<img src="/images/hero.jpg" class="card-img-top w-full h-full hero-image position-relative left-0 img-fluid object-cover max-h-96"
    alt="{{ $post->title }}">
@endif