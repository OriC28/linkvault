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
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('collection_id')->nullable()->constrained()->nullOnDelete();
            $table->string('url', 2048);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('favicon_url')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->integer('click_count')->default(0);
            $table->timestamp('last_clicked_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
