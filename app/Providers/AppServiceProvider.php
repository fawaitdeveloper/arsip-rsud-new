<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
          \URL::forceScheme(env('SCHEMA', 'http'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });

        Gate::define('secretary', function (User $user) {
            return $user->role === 'secretary';
        });

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        view()->composer('*', function ($view) {
            $view->with('notificationCount', Notification::where('user_id', auth()->user()->job_position_id ?? null)->count())
                ->with('notifications', Notification::where('user_id', auth()->user()->job_position_id ?? null)->orderBy('id', 'DESC')->take(10)->get())
                ->with('currentRoute', request()->route());
        });
    }
}
