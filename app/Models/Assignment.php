<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    // use HasFactory;
    protected $table = 'assignment';

    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'assignment_name',
        'assignment_date',
        'assignment_details',
        'location_id',
        'radius',
        'assignment_status',
        'is_active'
    ];
}
