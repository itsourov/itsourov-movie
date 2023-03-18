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
            $table->id();
            $table->integer('tmdb_id');
            $table->string('title', 255);
            $table->text('synopsis');
            $table->string('original_title', 255);
            $table->boolean('is_adult')->default(false);
            $table->date('release_date');
            $table->integer('runtime');
            $table->integer('rating');
            $table->json('images')->nullable();
            $table->string('poster');
            $table->string('backdrop');
            $table->json('trailers')->nullable();
            $table->json('cast')->nullable();
            $table->json('crew')->nullable();
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
