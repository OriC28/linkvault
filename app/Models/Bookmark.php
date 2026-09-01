<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['is_favorite'] ?? false, function ($query, $is_favorite_value){
            $query->where('is_favorite', $is_favorite_value);
        });

        $query->when($filters['without_collection'] ?? false, function ($query){
            $query->whereNull('collection_id');
        });

        $query->when($filters['desc'] ?? false, function ($query){
            $query->latest()->get();
        });

        $query->when($filters['asc'] ?? false, function ($query){
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
