<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    // use HasFactory;

    protected $table = 'borrow';

    protected $primaryKey = 'borrow_id';

    protected $fillable = [
        'borrow_date',
        'assignment_id',
        'user_id',
        'asset_id'
    ];
}
