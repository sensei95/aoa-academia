<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('post_name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('sex', 6);
            $table->string('civil_state');
            $table->string('phone');
            $table->string('country');
            $table->string('postal_code');
            $table->string('state');
            $table->string('city');
            $table->json('address');
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('status')->default('noverified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
