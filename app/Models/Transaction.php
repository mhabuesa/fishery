<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
}