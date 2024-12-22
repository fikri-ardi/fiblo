{{-- Posts --}}
<article id="post" class="row" id="post" x-data="{open: false}">
    @foreach ($posts as $post)
    {{-- Post --}}
    <livewire:components.post @post-deleted="$refresh" :post="$post" :photos="$photos" :key="$post->id" />
    @endforeach
</article>