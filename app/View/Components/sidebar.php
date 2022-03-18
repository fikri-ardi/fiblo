<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
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
        $userLinks = [
            'Dashboard' => [
                'active' => 'dashboard',
                'route' => route('dashboard.index'),
                'icon' => 'home',
            ],
            'Posts' => [
                'active' => 'dashboard/posts*',
                'route' => route('posts.index'),
                'icon' => 'file-text',
            ],
        ];

        $adminLinks = [
            'Users' => [
                'active' => 'dashboard/users',
                'route' => route('users.index'),
                'icon' => 'users',
            ],
            'Categories' => [
                'active' => 'dashboard/categories*',
                'route' => route('categories.index'),
                'icon' => 'grid',
            ],
            'Roles' => [
                'active' => 'dashboard/roles*',
                'route' => route('roles.index'),
                'icon' => 'users',
            ],
        ];

        return view('components.dashboard._sidebar', compact(['userLinks', 'adminLinks']));
    }
}