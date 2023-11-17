<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Patient\Contracts\PatientServiceContract;
use App\Services\Patient\PatientService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientServiceContract::class, PatientService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
