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
            $table->string("firstUserName");
            $table->string("secondUserName");
            $table->integer("firstUserScore");
            $table->integer("secondUserScore");
            $table->time("duration");
            $table->time("timeLeft");
            $table->string("sportType");
            $table->string("competetionType");
            $table->foreignId("tourna_id")->nullable();
            $table->foreignId("league_id")->nullable();
            $table->timestamps();
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
