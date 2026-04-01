<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('passage_id')->constrained()->onDelete('cascade');
            $table->ulid('destination_passage_id');
            $table->string('label');
            $table->json('condition_requirement')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('destination_passage_id')->references('id')->on('passages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
