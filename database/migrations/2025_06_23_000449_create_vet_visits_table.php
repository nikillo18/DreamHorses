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
        Schema::create('vet_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Horse::class);
            $table->date('visit_date');
            $table->string('vet_name');
            $table->string('vet_phone')->nullable();
            $table->string('diagnosis');
            $table->string('treatment');
            $table->date('next_visit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vet_visits');
    }
};
