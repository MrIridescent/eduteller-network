<?php

use App\Enums\NarrativeStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passages', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('story_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('content');
            $table->string('stage')->default(NarrativeStage::ORDINARY_WORLD->value);
            $table->boolean('is_start')->default(false);
            $table->boolean('is_end')->default(false);
            $table->json('metadata')->nullable();
            $table->ulidMorphs('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passages');
    }
};
