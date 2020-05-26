<?php

namespace App;

use App\Ambassador;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(AmbassadorGuarantor::class);
    }
}