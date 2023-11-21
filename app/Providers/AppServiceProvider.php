<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Patient\PatientService;
use App\Services\Patient\Contracts\PatientServiceContract;
use App\Services\Integrations\ViaCepService;
use App\Services\Integrations\Contracts\ViaCepServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientServiceContract::class, PatientService::class);
        $this->app->bind(ViaCepServiceContract::class, ViaCepService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
