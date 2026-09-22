<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

use App\Services\GoogleLoginService as ServicesGoogleLoginService;
use App\Services\Contracts\SocialLoginServiceInterface;
use App\Services\MetadataExtractorService;
use App\Observers\BookmarkObserver;
use App\Models\Collection;
use App\Models\Bookmark;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Bookmark::observe(BookmarkObserver::class);
        Model::preventLazyLoading(! app()->isProduction());

        Route::bind('combined_item', function ($value) {
            $type = request()->route('type');
            $user = request()->user();
            $models = [
                'bookmark' => Bookmark::class,
                'collection' => Collection::class,
            ];

            if (! array_key_exists($type, $models)) {
                throw new ModelNotFoundException;
            }

            return $models[$type]::where('user_id', $user->id)->withTrashed()->findOrFail($value);
        });
    }
}
