<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('item_type'); // 'novel' or 'book'
            $table->unsignedBigInteger('item_id');
            $table->enum('status', ['bookmark', 'readlist', 'history'])->default('bookmark');
            $table->unsignedBigInteger('progress')->nullable(); // chapter_id for reading progress
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Unique constraint: one entry per user per item per status
            $table->unique(['user_id', 'item_type', 'item_id', 'status'], 'library_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};
