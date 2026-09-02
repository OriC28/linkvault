<?php

namespace App\Providers;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\BookmarkRepository;
use App\Services\Contracts\SocialLoginServiceInterface;
use App\Services\GoogleLoginService as ServicesGoogleLoginService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SocialLoginServiceInterface::class,
            ServicesGoogleLoginService::class,
        );

        $this->app->bind(
            RepositoryInterface::class,
            BookmarkRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
    }
}
