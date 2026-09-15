<?php

namespace App\Providers;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\BookmarkRepository;
use App\Services\Contracts\SocialLoginServiceInterface;
use App\Services\GoogleLoginService as ServicesGoogleLoginService;
use App\Services\MetadataExtractorService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;
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

        $this->app->bind(
            MetadataExtractorService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());

        Route::bind('combined_item', function ($value) {
            $type = request()->route('type');
            $models = [
                'bookmark'  => \App\Models\Bookmark::class,
                'collection' => \App\Models\Collection::class,
            ];

            if (!array_key_exists($type, $models)) {
                throw new ModelNotFoundException();
            }

            return $models[$type]::withTrashed()->findOrFail($value);
        });
    }
}
