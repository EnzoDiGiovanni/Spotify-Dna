<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SpotifyProfile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function tracks()
    {
        return $this->belongsToMany(Track::class);
    }
}
