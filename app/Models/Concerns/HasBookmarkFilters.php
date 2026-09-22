<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasBookmarkFilters
{
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['is_favorite'] ?? false, function ($query, $is_favorite_value) {
            $query->where('is_favorite', $is_favorite_value);
        });

        $query->when(!empty($filters['search']), function ($query) use ($filters) {
            $keyword = addcslashes($filters['search'], '%_');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('url', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        });

        $query->when($filters['without_collection'] ?? false, function ($query) {
            $query->whereNull('collection_id');
        });

        $query->when($filters['recent'] ?? false, function ($query) {
            $query->latest();
        });

        $query->when($filters['oldest'] ?? false, function ($query) {
            $query->oldest();
        });

        $query->when($filters['alphaDesc'] ?? false, function ($query) {
            $query->orderBy('title', 'desc');
        });

        $query->when($filters['alphaAsc'] ?? false, function ($query) {
            $query->orderBy('title', 'asc');
        });
    }
    public function scopeFilteredAndPaginated(Builder $query, array $relations, array $filters, int $perPage = 6)
    {
        $order_filters = ['recent', 'oldest', 'alphaDesc', 'alphaAsc'];
        $hasOrderFilter = empty(array_intersect(array_keys($filters), $order_filters));

        return $query->with($relations)
            ->filter($filters)
            ->when($hasOrderFilter, fn($q) => $q->orderBy('created_at', 'desc'))
            ->paginate($perPage)
            ->withQueryString();
    }
}
