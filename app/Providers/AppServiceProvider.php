<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view){
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
            $my_id = Auth::id();
            $group = User::find($my_id);
            $users = $group->group_member()->get();
            $view->with('users', $users );
            }else {
            $view->with('users', 0);
            }
        });
        view()->composer('*', function ($view)
            {
            $view->with('cartItem', 'asdrr' );
            });
        });
    }
}
