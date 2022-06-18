<?php

namespace App\Providers;

use App\View\Components\Form\FormLogin;
use App\View\Components\Nav\MenuPainelAdmin;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('component-login', FormLogin::class);
        Blade::component('component-menu-painel-admin', MenuPainelAdmin::class);
    }
}
