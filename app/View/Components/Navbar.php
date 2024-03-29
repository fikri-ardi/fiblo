<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $links = collect([
            'Beranda' => [
                'route' => route('home'),
                'isActive' => request()->routeIs('home'),
                'icon' => 'bi bi-house-door',
            ],
            'Tulisan' => [
                'route' => route('user_posts.index'),
                'isActive' => request()->routeIs('user_posts*') && !request()->routeIs('user_posts/categories') && !request()->routeIs('user_posts.create'),
                'icon' => 'bi bi-file-post',
            ],
            'Buat Post' => [
                'route' => route('user_posts.create'),
                'isActive' => request()->routeIs('user_posts.create') && !request()->routeIs('user_posts/categories'),
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

        return view('components._navbar', compact('links', 'desktop'));
    }
}
