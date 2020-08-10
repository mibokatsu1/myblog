<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Blade;   //追加

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
        // 追加
        // Blade::directive('markdown', function ($expression) {

        //     $markdown = view(
        //         str_replace('\'', '', $expression)
        //     )->render();
    
        //     $Parsedown = new \Parsedown();
        //     return $Parsedown->text($markdown);
    
        // });
    }
}
