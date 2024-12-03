<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('speedruns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('game_name');
            $table->string('category');
            $table->time('run_time');
            $table->timestamp('date_submitted')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('video_url')->nullable();
            $table->boolean('verified_status')->default(false);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speedruns');
    }
};
