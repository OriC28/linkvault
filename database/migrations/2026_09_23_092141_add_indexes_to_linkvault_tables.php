<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->index(['user_id', 'created_at']);
            $table->index(['user_id', 'is_favorite']);
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->index('slug');
        });

        Schema::table('bookmark_tag', function (Blueprint $table) {
            $table->unique(['bookmark_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['user_id', 'is_favorite']);
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });

        Schema::table('bookmark_tag', function (Blueprint $table) {
            $table->dropUnique(['bookmark_id', 'tag_id']);
        });
    }
};
