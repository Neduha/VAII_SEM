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
        Schema::table('speedruns', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->text('description')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('speedruns', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('description');
        });
    }
};
