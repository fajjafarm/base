<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\PoolList;
use Illuminate\Support\Facades\View;

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
            
            $pools = $query->select('pool_id', 'pool_name')
                          ->orderBy('pool_name')
                          ->get();
            
            $view->with('pools', $pools);
        });
        View::composer('partials.thermal-suite-menu', function ($view) {
            $clientId = request()->query('client_id');
            
            $thermalSuites = ThermalSuite::with('checks') // Eager load for lastCheck()
                ->when($clientId, fn($query) => $query->where('client_id', $clientId))
                ->select('id', 'thermal_name', 'check_interval')
                ->orderBy('thermal_name')
                ->get();
            
            $view->with('thermalSuites', $thermalSuites);
        });
    }
}
