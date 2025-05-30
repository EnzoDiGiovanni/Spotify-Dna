<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function spotifyProfile()
    {
        return $this->belongsToMany(SpotifyProfile::class);
    }
}
