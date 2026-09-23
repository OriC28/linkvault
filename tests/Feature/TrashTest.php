<?php

use App\Models\User;
use App\Models\Bookmark;
use App\Actions\EmptyAllRegistersAction;
use App\Exceptions\NoChangesDetectedException;

describe('Trash System', function () {

    it('moves deleted bookmarks to trash and hides them from index', function () {
        /** @var \Tests\TestCase $this */

        $user = User::factory()->create();
        $bookmark = Bookmark::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('bookmarks.destroy', $bookmark))
            ->assertRedirect(route('bookmarks.index'));

        $this->assertSoftDeleted($bookmark);

        $this->actingAs($user)
            ->get(route('bookmarks.index'))
            ->assertStatus(200);

        $this->actingAs($user)
            ->get(route('trash.index'))
            ->assertSee($bookmark->title);
    });

    it('empties only the current users trash', function () {
        /** @var \Tests\TestCase $this */

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $bookmark1 = Bookmark::factory()->create(['user_id' => $user1->id, 'deleted_at' => now()]);
        $bookmark2 = Bookmark::factory()->create(['user_id' => $user2->id, 'deleted_at' => now()]);

        $action = app(EmptyAllRegistersAction::class);
        $action($user1);

        $this->assertDatabaseMissing('bookmarks', ['id' => $bookmark1->id]);
        $this->assertDatabaseHas('bookmarks', ['id' => $bookmark2->id]);
    });

    it('throws exception if trash is already empty', function () {
        $user = User::factory()->create();

        $action = app(EmptyAllRegistersAction::class);
        $action($user);
    })->throws(NoChangesDetectedException::class);
});
