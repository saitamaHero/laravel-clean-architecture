<?php

namespace App\Providers;

use App\Core\Modules\Domain\Repositories\ModuleRepository;
use App\Core\Modules\Infrastructure\Cache\LaravelCache;
use App\Core\Modules\Infrastructure\Persistence\EloquentModuleRepository;
use App\Core\Shared\Application\Cache\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Cache::class, LaravelCache::class);
        $this->app->bind(ModuleRepository::class, EloquentModuleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
