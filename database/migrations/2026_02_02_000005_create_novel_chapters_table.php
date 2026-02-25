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
        Schema::create('novel_chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novel_id')->constrained('novels')->onDelete('cascade');
            $table->string('title');
            $table->longText('content');
            $table->unsignedInteger('chapter_number');
            $table->boolean('is_premium')->default(false);
            $table->unsignedInteger('views')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novel_chapters');
    }
};
