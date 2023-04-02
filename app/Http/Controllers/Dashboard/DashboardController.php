<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        /**
         * Get the dynamic greetings word
         * @return string
         */
        $greet = Carbon::greeting();

        return view('dashboard.index', compact('greet'));
    }
}
