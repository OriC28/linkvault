<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Concerns\HasBookmarkFilters;
use App\Presenters\BookmarkPresenter;

#[Fillable(['user_id', 'url', 'title', 'description', 'collection_id', 'is_favorite'])]
class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory, SoftDeletes, HasBookmarkFilters;

    protected ?BookmarkPresenter $presenterInstance = null;

    protected function casts(): array
    {
        return [
            'last_clicked_at' => 'datetime',
            'is_favorite' => 'boolean'
        ];
    }

    /**
     * Get presenter object to format user data for view.
     *
     * @return BookmarkPresenter
     */
    public function present(): BookmarkPresenter
    {
        if (!$this->presenterInstance) {
            $this->presenterInstance = app(BookmarkPresenter::class, ['bookmark' => $this]);
        }
        return $this->presenterInstance;
    }

    public function scopeTotalThisWeek(Builder $builder, array $range_week)
    {
        return $builder->whereBetween('created_at', $range_week)->count();
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
