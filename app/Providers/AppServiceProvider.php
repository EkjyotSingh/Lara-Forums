<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
<<<<<<< HEAD
        View::share('channels',Channel::with('discussions')->get());
=======
        View::share('channels',Channel::all());
>>>>>>> 3c2ceeb1206dab4c6b339d13a99661c7f1ef414f
    }
}
