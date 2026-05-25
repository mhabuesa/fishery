<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    protected $fillable = [
        'name',
        'location',
        'size',
        'lease_amount',
        'start_date',
        'end_date',
        'status',
        'note',
    ];
}
