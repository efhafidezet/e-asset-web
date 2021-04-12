<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    // use HasFactory;

    protected $table = 'track';

    protected $primaryKey = 'track_id';

    protected $fillable = [
        'borrow_id',
        'track_time',
        'latitude',
        'longitude'
    ];
}
