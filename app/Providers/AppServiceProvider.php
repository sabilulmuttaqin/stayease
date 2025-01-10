<?php

namespace App\Providers;

use App\Repositories\boardingHouseRepository;
use App\Repositories\categoryRepository;
use App\Repositories\cityRepository;
use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use App\Repositories\Contract\cityRepositoryInterface;
use App\Repositories\Contract\transactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(cityRepositoryInterface::class, cityRepository::class);
        $this->app->bind(categoryRepositoryInterface::class, categoryRepository::class);
        $this->app->bind(boardingHouseRepositoryInterface::class, boardingHouseRepository::class);
        $this->app->bind(transactionRepositoryInterface::class, transactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (str_contains(request()->url(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }
    }
}
