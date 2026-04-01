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
        Schema::create('schools', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location');
            $table->decimal('fee_range_min', 12, 2)->nullable();
            $table->decimal('fee_range_max', 12, 2)->nullable();
            $table->json('attributes'); // Culture, Safety, Nurture levels (0-5)
            $table->json('facilities');
            $table->text('mission_statement')->nullable();
            $table->timestamps();
        });

        Schema::create('investigations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('school_id');
            $table->ulid('strategist_id'); // Eduteller Herself or certified consultant
            $table->date('investigation_date');
            $table->integer('culture_score');
            $table->integer('safety_score');
            $table->integer('nurture_score');
            $table->text('summary_report');
            $table->json('raw_findings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigations');
        Schema::dropIfExists('schools');
    }
};
