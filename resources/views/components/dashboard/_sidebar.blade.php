<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @foreach ($userLinks as $name => $value)
            <x-_list-link :active="$value['active']" :href="$value['route']">
                <span data-feather="{{ $value['icon'] }}"></span>
                {{ $name }}
            </x-_list-link>
            @endforeach
        </ul>

        @can('role', 'founder')
        <h6 class="p-3 text-gray-500">ADMINISTRATOR</h6>
        <ul class="nav flex-column">
            @foreach ($adminLinks as $name => $value)
            <x-_list-link :active="$value['active']" :href="$value['route']">
                <span data-feather="{{ $value['icon'] }}"></span>
                {{ $name }}
            </x-_list-link>
            @endforeach
        </ul>
        @endcan

    </div>
</nav>