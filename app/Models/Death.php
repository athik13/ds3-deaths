<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;

    public function boss()
    {
        return $this->belongsTo('App\Models\Boss');
    }
}
