<?php

namespace App\Providers;

use App\Models\Size;
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

        // send categories to menu, create and update views
        view()->composer(['partials.menu','back.products.create','back.products.edit'],function($view) {
            $categories = Category::pluck('category','id')->all();
            $view->with('categories' , $categories);
        });

        // send the sizes to create and update views
        view()->composer(['back.products.create','back.products.edit'], function($view) {
            $sizes = Size::all();
            $view->with('sizes', $sizes);
        });

        // display footer only on front views
        view()->composer('layouts.master', function($view) {
            $showFooter = Route::is('admin.*') ? false : true;
            $view->with('showFooter', $showFooter);
        });


    }
}
