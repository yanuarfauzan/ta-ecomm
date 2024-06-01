<?php

namespace App\Providers;

use App\Models\ProductAssessment;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Observers\ProductAssessmentObserver;

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
        Paginator::useBootstrapFive();
        // if (config('app.env') === 'local'){
        //     URL::forceScheme('https');
        // }
        ProductAssessment::observe(ProductAssessmentObserver::class);
    }
}
