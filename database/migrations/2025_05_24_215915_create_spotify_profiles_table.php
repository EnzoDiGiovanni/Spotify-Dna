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
        Schema::create('spotify_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('spotify_id')->unique();
            $table->string('display_name')->nullable();
            $table->string('email')->nullable();
            $table->text('access_token');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spotify_profiles');
    }
};