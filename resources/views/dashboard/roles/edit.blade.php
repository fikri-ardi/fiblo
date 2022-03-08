<x-dashboard-layout title="Ubah Role">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ubah Role</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @method('put')
                @csrf
                <x-_input name="name" :model="$role" label="Role Name"></x-_input>
                <x-_button>Ubah Role</x-_button>
            </form>
        </div>
    </main>
</x-dashboard-layout>