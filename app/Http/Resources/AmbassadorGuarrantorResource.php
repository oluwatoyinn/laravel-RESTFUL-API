<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AmbassadorGuarrantorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'gender'=>$this->gender,
            'passport'=>$this->passport,
            'officeAdress'=>$this->office_address,
            'homeAddress'=>$this->home_address,
            'occupation'=>$this->occupation,
            'phoneNumber'
        ];
    }
}
