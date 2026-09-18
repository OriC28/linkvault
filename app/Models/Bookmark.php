<?php

namespace App\Models;

use App\Presenters\BookmarkPresenter;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\MetadataExtractorService;
use Override;

#[Guarded([])]
class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'last_clicked_at' => 'datetime',
            'is_favorite' => 'boolean'
        ];
    }

    #[Override]
    protected static function booted()
    {
        static::creating(function ($bookmark) {
            $extractor = app(MetadataExtractorService::class);
            $bookmark->favicon_url = $extractor->getFaviconToURL($bookmark->url);
        });

        static::addGlobalScope('order_desc', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    /**
     * Get presenter object to format user data for view.
     *
     * @return BookmarkPresenter
     */
    public function present(): BookmarkPresenter
    {
        return new BookmarkPresenter($this);
    }

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

        $query->when($filters['desc'] ?? false, function ($query) {
            $query->latest()->get();
        });

        $query->when($filters['asc'] ?? false, function ($query) {
            $query->oldest()->get();
        });

        $query->when($filters['dateDesc'] ?? false, function ($query) {
            $query->orderBy('title', 'desc')->get();
        });

        $query->when($filters['dateAsc'] ?? false, function ($query) {
            $query->orderBy('title', 'asc')->get();
        });

        $query->when($filters['orderDesc'] ?? false, function ($query) {
            $query->latest()->get();
        });

        $query->when($filters['orderAsc'] ?? false, function ($query) {
            $query->oldest()->get();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
