<?php

namespace App\Providers;

use App\Contracts\Mediator\DtoMediatorContract;
use App\Contracts\Repositories\TransactionRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Repositories\WalletRepositoryContract;
use App\Contracts\Services\TransactionServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Contracts\Services\WalletServiceContract;
use App\Mediator\DtoMediator;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Services\TransactionService;
use App\Services\UserService;
use App\Services\WalletService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */

    public array $singletons = [
        // Repo
        WalletRepositoryContract::class      => WalletRepository::class,
        TransactionRepositoryContract::class => TransactionRepository::class,
        UserRepositoryContract::class        => UserRepository::class,

        // Service
        WalletServiceContract::class         => WalletService::class,
        TransactionServiceContract::class    => TransactionService::class,
        UserServiceContract::class           => UserService::class,

        //Others
        DtoMediatorContract::class           => DtoMediator::class,
    ];

    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        //
    }
}
