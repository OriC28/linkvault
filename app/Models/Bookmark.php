<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;

use App\Models\Concerns\HasBookmarkFilters;
use App\Presenters\BookmarkPresenter;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'url', 'title', 'description', 'collection_id', 'is_favorite'])]
class Bookmark extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarkFactory> */
    use HasFactory, SoftDeletes, HasBookmarkFilters;

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
        return new BookmarkPresenter($this);
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
