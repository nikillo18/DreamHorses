<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Horse;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blacksmiths', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Horse::class)->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('name');
            $table->string('horseshoe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blacksmiths');
    }
};
