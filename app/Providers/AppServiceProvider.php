<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Grade;

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
        View::composer('*', function ($view) {
            $grades = Grade::all();
            $view->with('grades', $grades);
        });
    }
}
