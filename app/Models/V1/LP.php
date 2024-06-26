<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class LP extends BaseModel
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'artist_id',
    ];

    public function artist()
    {
        return $this->belongsTo('App\Models\V1\Artist');
    }

    public function songs()
    {
        return $this->hasMany('App\Models\V1\Song');
    }
}
