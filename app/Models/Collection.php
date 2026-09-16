<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Override;

#[Fillable(['name', 'description', 'is_public'])]
class Collection extends Model
{
    use HasFactory, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    #[Override]
    protected static function booted()
    {
        static::creating(function ($collection) {
            $maxOrder = static::max('sort_order');

            $collection->sort_order = ($maxOrder ?? 0) + 1;

            $collection->slug = Str::slug($collection->name);
        });
    }

    public function isPublicText(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['is_public'] ? 'Público' : 'Privado'
        );
    }

    #[Override]
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
