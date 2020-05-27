<?php

namespace App;

use App\Ambassador;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    //

    // public function ambassador(){
    //     return $this->belongsTo(Ambassador::class);
    // }
    public function ambassadorGuarantor(){
        return $this->hasOne(AmbassadorGuarantor::class);
    }

    public function images(){
        return $this->hasMany(AmbassadorGuarantor::class);
    }

}