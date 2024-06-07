<?php

namespace App\Providers;

use App\ViewComposers\MainMenuViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the main menu view composer.
        View::composer('layouts.app', MainMenuViewComposer::class);
    }
}
