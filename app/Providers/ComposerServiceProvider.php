<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        // Compartilhando a variável com todas a as views
        $categories = \App\Category::all([
            'name',
            'slug'
        ]);

        // view()->share('categories', $categories);

        // view()->composer(['welcome', 'single', 'cart'], function($view) use($categories){
        //     $view->with('categories', $categories);
        // });

        // view()->composer(['*'], 'App\Http\Views\CategoryViewComposer@compose');
        // view()->composer(
        //     [
            //         'welcome',
        //         'single',
        //         'cart',
        //         'layouts.front',
        //         'category'
        //     ],
        //     'App\Http\Views\CategoryViewComposer@compose'
        // );
        view()->composer(['layouts.front'], 'App\Http\Views\CategoryViewComposer@compose');
    }
}
