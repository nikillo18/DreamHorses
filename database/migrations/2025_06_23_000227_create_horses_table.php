<?php

use App\Models\User;
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
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('breed');
            $table->string('color');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('photo_path')->nullable();
            $table->string('number_microchip')->nullable();
            $table->foreignId('boss_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('caretaker_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
