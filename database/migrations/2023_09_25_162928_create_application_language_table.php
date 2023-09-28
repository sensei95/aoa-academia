<?php

use App\Models\Application;
use App\Models\Language;
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
        Schema::create('application_language', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class)
            ->constrained()
            ->cascadeOnDelete();
            $table->foreignIdFor(Language::class)
            ->constrained()
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_language');
    }
};
