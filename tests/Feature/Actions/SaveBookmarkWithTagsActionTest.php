<?php

use App\Actions\SaveBookmarkWithTagsAction;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Tag;
use App\Exceptions\NoChangesDetectedException;

describe('SaveBookmarkWithTagsAction', function () {
    
    it('creates a new bookmark and tags', function () {
        $user = User::factory()->create();
        $action = app(SaveBookmarkWithTagsAction::class);
        
        $tags = collect([
            ['id' => null, 'value' => 'New Tag']
        ]);

        $bookmark = $action(
            user: $user,
            bookmark: new Bookmark(),
            data: [
                'url' => 'https://example.com',
                'title' => 'Test Bookmark',
                'is_favorite' => false
            ],
            tags: $tags
        );

        expect($bookmark->id)->not->toBeNull()
            ->and($bookmark->tags)->toHaveCount(1)
            ->and($bookmark->tags->first()->name)->toBe('New Tag');
    });

    it('throws exception if no changes detected on update', function () {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['user_id' => $user->id, 'name' => 'Existing']);
        
        $bookmark = Bookmark::factory()->create([
            'user_id' => $user->id,
            'url' => 'https://example.com',
            'title' => 'Test Bookmark',
            'is_favorite' => false
        ]);
        $bookmark->tags()->attach($tag->id);

        $action = app(SaveBookmarkWithTagsAction::class);
        
        $tags = collect([
            ['id' => $tag->id, 'value' => 'Existing']
        ]);

        $action(
            user: $user,
            bookmark: $bookmark,
            data: [
                'url' => 'https://example.com',
                'title' => 'Test Bookmark',
                'is_favorite' => false
            ],
            tags: $tags
        );
    })->throws(NoChangesDetectedException::class);
});
