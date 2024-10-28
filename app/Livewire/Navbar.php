<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    protected $listeners = ['user-updated' => '$refresh'];

    public function render()
    {
        $links = collect([
            'Beranda' => [
                'route' => route('home'),
                'isActive' => request()->routeIs('home'),
                'icon' => 'bi bi-house-door',
            ],
            'Tulisan' => [
                'route' => route('posts.index'),
                'isActive' => request()->routeIs('posts*') && !request()->routeIs('posts/categories') && !request()->routeIs('posts.create'),
                'icon' => 'bi bi-file-post',
            ],
            'Buat Post' => [
                'route' => route('posts.create'),
                'isActive' => request()->routeIs('posts.create') && !request()->routeIs('posts/categories'),
                'icon' => 'bi bi-plus-circle',
            ],
            'Eksplor' => [
                'route' => route('explore'),
                'isActive' => request()->routeIs('explore'),
                'icon' => 'bi bi-compass',
            ],
        ]);

        $desktop = $links->filter(function ($value, $key) {
            return $key != 'Buat Post';
        });

        return view('components.navbar', compact('links', 'desktop'));
    }
}