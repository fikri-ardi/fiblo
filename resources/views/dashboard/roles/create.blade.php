<x-dashboard-layout title="Buat Role Baru">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buat Role Baru</h1>
        </div>

        <div class="col-lg-4 mb-5">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <x-_input name="name" label="Role Name"></x-_input>
                <div class="flex justify-end mt-3">
                    <x-_button>Buat Role</x-_button>
                </div>
            </form>
        </div>
    </main>
</x-dashboard-layout>