<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Presenters\UserPresenter;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'google_id', 'avatar_url', 'last_login_at'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected ?UserPresenter $presenterInstance = null;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'last_login_at' => 'datetime',
        ];
    }
    /**
     * Get presenter object to format user data for view.
     *
     * @return UserPresenter
     */
    public function present(): UserPresenter
    {
        if (!$this->presenterInstance) {
            $this->presenterInstance = new UserPresenter($this);
        }
        return $this->presenterInstance;
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
