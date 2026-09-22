<?php

namespace App\Presenters;

use App\Models\User;

class UserPresenter
{

    public function __construct(protected User $user) {}

    public function initialsName(): string
    {
        $nameArray = explode(' ', $this->user->name);
        $initialsArray = array_map(fn($word) => ucfirst($word[0]), $nameArray);
        $initials = array_slice($initialsArray, 0, 2);
        return implode("", $initials);
    }

    public function fullName(): string
    {
        $nameArray = explode(' ', $this->user->name);
        $arrayLength = count($nameArray);

        if ($arrayLength > 2) {
            return "{$nameArray[0]} {$nameArray[2]}";
        }
        return $this->user->name;
    }

    public function tagsWithId(): array
    {
        $tags_with_id = $this->user->tags->map(
            fn($tag) => [
                'id' => $tag->id,
                'value' => $tag->name,
            ]
        )->toArray();

        return $tags_with_id;
    }
}
