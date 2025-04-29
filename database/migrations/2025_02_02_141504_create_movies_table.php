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
        Schema::create('movies', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('uuid')->unique();
            $table->string('title', 255);
            $table->string('original_name', 255)->nullable();
            $table->longText('link_film')->nullable();
            $table->longText('description')->nullable();
            $table->string('cast', 500)->nullable();
            $table->string('director', 100)->nullable();
            $table->string('time', 100)->nullable();
            $table->string('current_episode', 100)->nullable();
            $table->string('total_episodes', 100)->nullable();
            $table->string('year', 50)->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('format_id')->constrained('formats')->onDelete('cascade');
            $table->foreignId('caption_id')->constrained('captions')->onDelete('cascade');
            $table->string('poster', 255)->nullable();
            $table->string('banner', 255)->nullable();
            $table->boolean('is_film_hot')->default(false);
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
