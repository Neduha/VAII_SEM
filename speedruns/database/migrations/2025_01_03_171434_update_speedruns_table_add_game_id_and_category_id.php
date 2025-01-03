<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('speedruns', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->after('user_id');
            $table->unsignedBigInteger('category_id')->after('game_id');


            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('speedruns', function (Blueprint $table) {
            $table->dropForeign(['game_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn('game_id');
            $table->dropColumn('category_id');
        });
    }
};

