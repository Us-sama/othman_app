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
        Schema::create('demandeur_formation', function (Blueprint $table) {
            $table->unsignedBigInteger('demandeur_id');
            $table->unsignedBigInteger('formation_id');
            $table->timestamps();

            $table->foreign('demandeur_id')->references('id')->on('demandeurs')->onDelete('cascade');
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');

            $table->primary(['demandeur_id', 'formation_id']);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeur_formation');
    }
};
