<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        Blade::directive('convert', function ($money) {
            return "<?php echo laravel\Cashier\Cashier::formatAmount($money, 'gbp'); ?>";
        });

        User::created(function ($user) {
            $user->roles()->attach(1);
        });
    }
}
