<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnM extends Model
{
    // use HasFactory;
    protected $table = 'return';

    protected $primaryKey = 'return_id';

    protected $fillable = [
        'return_date',
        'borrow_id',
        'image',
    ];
}
