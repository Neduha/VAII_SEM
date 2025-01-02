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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Game name
            $table->text('description')->nullable(); // Optional game description
            $table->date('release_date')->nullable(); // Optional release date
            $table->string('developer')->nullable(); // Developer of the game
            $table->string('image')->nullable(); // Path to the game image
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
