<?php

use App\Models\User;
use App\Models\Bookmark;

describe('Bookmark Scopes', function () {
    
    it('filters by search keyword in title or url', function () {
        $user = User::factory()->create();
        
        Bookmark::factory()->create(['user_id' => $user->id, 'title' => 'Laravel News', 'url' => 'https://news.com']);
        Bookmark::factory()->create(['user_id' => $user->id, 'title' => 'Vue Tips', 'url' => 'https://vue.com']);

        // Buscar por título ignorando mayúsculas
        $resultsTitle = Bookmark::where('user_id', $user->id)->filter(['search' => 'laravel'])->get();
        expect($resultsTitle)->toHaveCount(1)
            ->and($resultsTitle->first()->title)->toBe('Laravel News');
            
        // Buscar por URL
        $resultsUrl = Bookmark::where('user_id', $user->id)->filter(['search' => 'vue.com'])->get();
        expect($resultsUrl)->toHaveCount(1)
            ->and($resultsUrl->first()->title)->toBe('Vue Tips');
    });

    it('filters correctly by is_favorite status', function () {
        $user = User::factory()->create();
        
        Bookmark::factory()->create(['user_id' => $user->id, 'is_favorite' => true]);
        Bookmark::factory()->create(['user_id' => $user->id, 'is_favorite' => false]);

        $results = Bookmark::where('user_id', $user->id)->filter(['is_favorite' => true])->get();
        
        expect($results)->toHaveCount(1)
            ->and($results->first()->is_favorite)->toBeTrue();
    });
});
