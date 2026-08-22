<?php

namespace App\Presenters;

use App\Models\User;

class UserPresenter
{
    protected User $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function initialsName(): string
    {
        $nameArray = explode(' ', $this->user->name);
        $initialsArray = array_map(fn ($word) => ucfirst($word[0]), $nameArray);
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
}


?>
