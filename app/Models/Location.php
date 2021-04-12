<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_name',
        'latitude',
        'longitude',
        'is_active'
    ];
}
