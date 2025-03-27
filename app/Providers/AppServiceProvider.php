<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        View::composer('partials.sidebar-menu', function ($view) {
            $clientId = request()->query('client_id');
            
            $query = PoolList::query();
            if ($clientId) {
                $query->where('client_id', $clientId);
            }
            
            $pools = $query->select('id', 'pool_name')
                          ->orderBy('pool_name')
                          ->get();
            
            $view->with('pools', $pools);
        });
    }
}
