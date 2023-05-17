<?php

namespace App\Providers;

use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        view()->composer('*', function($view) {
            $user = Auth::user();
            if($user) {
                $user_settings = UserSettings::where('user_id', Auth::user()->id)->first();
                $view->with('user_settings', $user_settings); 
            }
        });
    }
}
