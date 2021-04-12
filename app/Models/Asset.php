<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    // use HasFactory;
    protected $table = 'asset';

    protected $primaryKey = 'asset_id';

    protected $fillable = [
        'asset_name',
        'asset_type',
        'asset_unique',
        'asset_year',
        'status',
        'is_active'
    ];
}
