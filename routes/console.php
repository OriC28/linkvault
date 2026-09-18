<?php

use App\Models\Bookmark;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    Bookmark::onlyTrashed()
        ->where('deleted_at', '<=', now()->subDays(30))
        ->forceDelete();
})->daily();
