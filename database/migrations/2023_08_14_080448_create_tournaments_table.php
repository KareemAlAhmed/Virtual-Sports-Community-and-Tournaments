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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->integer("maxPlaces");
            $table->integer("remainingPlaces");
            $table->integer("takesPlaces")->default(0);
            $table->text("rewards");
            $table->text("requirements");
            $table->string("sportType");
            $table->date("startDate");
            $table->date("endDate");
            $table->foreignId("winner_id")->default(Null)->nullable();
            $table->foreignId("organizer_id")->constrained('users')->cascadeOnDelete();
            $table->string("type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
