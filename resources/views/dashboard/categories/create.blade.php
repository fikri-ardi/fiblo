<x-dashboard-layout title="Buat Kategori Baru">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buat Kategori Baru</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <x-_input name="name" :model="$category" label="Category Name"></x-_input>
                <x-_button>Tambah</x-_button>
            </form>
        </div>
    </main>
</x-dashboard-layout>