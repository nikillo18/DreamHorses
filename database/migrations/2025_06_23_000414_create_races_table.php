<?php

use App\Models\Horse;
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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignIdFor(Horse::class)->constrained()->onDelete('cascade');
            $table->string('hipodromo');
            $table->integer('place')->nullable();
            $table->string('video')->nullable();
            $table->integer('distance')->default(0);
            $table->string('description')->nullable();
            $table->string('jockey');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
