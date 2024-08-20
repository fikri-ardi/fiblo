<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Method to return a dynamic greetings word
         * @return string 
         */
        Carbon::macro('greeting', function () {
            $hour = intval(Carbon::now()->format('H'));
            if ($hour < 12) return 'morning';
            if ($hour >= 12 && $hour <= 17) return 'afternoon';
            return 'evening';
        });
    }
}
