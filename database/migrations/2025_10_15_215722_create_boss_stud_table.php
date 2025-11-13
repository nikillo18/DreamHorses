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
        Schema::create('boss_stud', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boss_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stud_id')->constrained('studs')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->unique(['boss_id', 'stud_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boss_stud');
    }
};
