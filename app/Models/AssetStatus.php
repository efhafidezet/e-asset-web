<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    // use HasFactory;
    protected $table = 'asset_status';

    protected $primaryKey = 'asset_status_id';

    protected $fillable = [
        'borrow_id',
        'asset_status_flag'
    ];
}
