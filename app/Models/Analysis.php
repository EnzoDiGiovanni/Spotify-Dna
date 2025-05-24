<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    public function spotifyProfile()
    {
        return $this->belongsTo(SpotifyProfile::class);
    }
}