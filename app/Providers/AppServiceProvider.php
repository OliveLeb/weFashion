<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
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
        Paginator::useBootstrap();

        // send categories to menu
        view()->composer('partials.menu',function($view) {
            $categories = Category::pluck('category','id')->all();
            $view->with('categories' , $categories);
        });

        // display footer only on front views
        view()->composer('layouts.master', function($view) {
            $showFooter = Route::is('admin.*') ? false : true;
            $view->with('showFooter', $showFooter);
        });
    }
}
