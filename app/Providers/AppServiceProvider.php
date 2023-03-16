<?php

namespace App\Providers;

use App\Contract\EmployeeRepositoryInterface;
use App\Repository\EmployeeRepository;
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
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }
}
