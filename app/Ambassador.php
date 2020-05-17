<?php

namespace App;

use App\Ambassador;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    //

    public function ambassador(){
        return $this->belongsTo(Ambassador::class);
    }
}