<x-dashboard-layout title="Buat Post Baru">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buat Post Baru</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <x-posts._form :action="route('posts.store')" :categories="$categories"></x-posts._form>
        </div>
    </main>

    <script src="/js/sluggable.js"></script>
    <script src="/js/image-previewer.js"></script>
</x-dashboard-layout>