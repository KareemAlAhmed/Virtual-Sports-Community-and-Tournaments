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
            $table->integer("firstUserScore")->default(Null)->nullable();
            $table->integer("secondUserScore")->default(Null)->nullable();
            $table->time("duration");
            $table->time("timeLeft");
            $table->time("startTime");
            $table->date("date");
            $table->string("sportType");
            $table->string("gameType");
            $table->string("competetionType");
            $table->string("status")->default('not started');
            $table->foreignId("tournaments_id")->default(Null)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId("leagues_id")->default(Null)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId("winner_id")->default(Null)->nullable();
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
