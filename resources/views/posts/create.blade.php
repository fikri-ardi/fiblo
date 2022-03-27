<x-app-layout title="Buat Post Baru">
    <x-slot name="style">
        <link rel="stylesheet" href="/css/trix.css">
    </x-slot>

    <div class="w-full sm:w-2/3 mb-5 mx-auto">
        <x-posts._form :action="route('user_posts.store')" :categories="$categories" button="publish"></x-posts._form>
    </div>

    <x-slot name="script">
        <script src="/js/trix.js"></script>
        <script src="/js/sluggable.js"></script>
        <script src="/js/image-previewer.js"></script>
    </x-slot>
</x-app-layout>