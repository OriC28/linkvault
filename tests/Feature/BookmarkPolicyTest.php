<?php

use App\Models\User;
use App\Models\Bookmark;
use App\Models\Collection;

describe('Bookmark Authorization', function () {

    it('prevents a user from updating or deleting another users bookmark', function () {
        /** @var \Tests\TestCase $this */

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $bookmark = Bookmark::factory()->create([
            'user_id' => $user2->id
        ]);

        $this->actingAs($user1)
            ->put(route('bookmarks.update', $bookmark), [
                'url' => 'https://example.com',
                'title' => 'Updated Title',
                'is_favorite' => false,
                'tags' => json_encode([['value' => 'tag1']])
            ])
            ->assertStatus(403); // Laravel Policy (or Gate) throws 403

        // Intentar eliminar
        $this->actingAs($user1)
            ->delete(route('bookmarks.destroy', $bookmark))
            ->assertStatus(403);
    });

    it('prevents assigning a bookmark to another users collection', function () {
        /** @var \Tests\TestCase $this */

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $collectionUser2 = Collection::factory()->create([
            'user_id' => $user2->id
        ]);

        $this->actingAs($user1)
            ->post(route('bookmarks.store'), [
                'url' => 'https://example.com',
                'title' => 'My Bookmark',
                'collection_id' => $collectionUser2->id,
                'is_favorite' => false,
                'tags' => json_encode([['value' => 'tag1']])
            ])
            ->assertInvalid(['collection_id']);
    });
});
