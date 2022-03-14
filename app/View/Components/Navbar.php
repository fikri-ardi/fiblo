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
        $links = [
            'Beranda' => [
                'route' => route('home'),
                'active' => '/',
                'icon' => 'bi bi-house-door',
            ],
            'Blog' => [
                'route' => route('posts'),
                'active' => 'posts*',
                'icon' => 'bi bi-journal-text',
            ],
            'Categories' => [
                'route' => route('categories'),
                'active' => 'posts/categories',
                'icon' => 'bi bi-grid',
            ],
            'About' => [
                'route' => route('about'),
                'active' => 'about',
                'icon' => 'bi bi-info-circle',
            ],
        ];

        return view('components._navbar', compact('links'));
    }
}