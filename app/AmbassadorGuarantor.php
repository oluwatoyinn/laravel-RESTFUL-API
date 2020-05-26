<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmbassadorGuarantor extends Model
{
    //

    // protected $fillable = [
    //     'name','age','occupation','office_address','home_address','phone_number','passport','ambassador_id','gender'
    //    ];

    public function ambassadorGuarantor(){
        return $this->belongsTo(AmbassadorGuarantor::class);
    }
}
