<x-dashboard-layout title="Semua User">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Semua User</h1>
        </div>

        <div class="table-responsive">
            <div class="flex mb-3">
                <x-_link href="{{ route('users.create') }}"><span class="bi bi-person-plus"></span> Tambah User</x-_link>
            </div>

            @if ($users->count())
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="badge bg-warning text-dark"> <span data-feather="edit-3"></span>
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="badge bg-danger text-white border-0" onclick="return confirm('Kamu yakin?')"> <span
                                        data-feather="x-circle"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">Data User kamu belum ada karena kamu belum ada usernya :v</div>
            @endif
        </div>
    </main>
</x-dashboard-layout>