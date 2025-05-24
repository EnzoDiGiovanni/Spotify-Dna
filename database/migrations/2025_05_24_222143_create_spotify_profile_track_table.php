<?php

use App\Models\SpotifyProfile;
use App\Models\Track;
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
        Schema::create('spotify_profile_track', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SpotifyProfile::class);
            $table->foreignIdFor(Track::class);
            $table->timestamp('played_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spotify_profile_track');
    }
};