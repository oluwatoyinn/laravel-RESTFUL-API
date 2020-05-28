<?php

namespace App\Http\Controllers;

use App\AmbassadorGuarantor;
use Illuminate\Http\Request;
use App\Http\Requests\GuarantorRequest;
use App\Http\Resources\AmbassadorGuarrantorResource;

class AmbassadorGuarantorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ambassador_guarantors = AmbassadorGuarantor::latest()->get();
        return $this->sendResponse(AmbassadorGuarrantorResource::collection($ambassador_guarantors));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name'=>'required',
            'gender'=>'required',
            'passport'=>'required|image|mimes:jpeg,png,git,svg|max:2048',
            'age'=>'required|numeric',
            'phone_number'=>'required',
            'occupation'=>'required',
            'office_address'=>'required',
            'ambassador_id'=>'required',
            'home_address'=>'required'
        ];
        $this->validate($request,$rules);

        $ambassador_guarantor = new AmbassadorGuarantor;

        $ambassador_guarantor->name =$request->name;
        $ambassador_guarantor->gender =$request->gender;
        $ambassador_guarantor->age =$request->age;
        $ambassador_guarantor->phone_number =$request->phone_number;
        $ambassador_guarantor->occupation =$request->occupation;
        $ambassador_guarantor->office_address =$request->office_address;
        $ambassador_guarantor->home_address =$request->home_address; 
        $ambassador_guarantor->ambassador_id =$request->ambassador_id;


        if($request->hasFile('passport'))
        {
            $image =$request->file('passport');
            $filename =$image->getClientOriginalName();
            $filesize =$image->getSize();
            $filextension= $image->getClientOriginalExtension();
            $save_image = time().".".$filextension;
        }

        $ambassador_guarantor->passport = $save_image;

        $ambassador_guarantor->save();

        $image->move('guarantor_image/', $save_image);



        // $image = $request->file('passport');

        // $new_name = time() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('guarantor_image/'), $new_name);
        // $guarantor_data = array(
        //     'name'       =>   $request->name,
        //     'gender'        =>   $request->gender,
        //     'phone_number' => $request->phone_number,
        //     'occupation' => $request->occupation,
        //     'office_address' =>$request->office_address,
        //     'home_address' =>$request ->home_address,
        //     'ambassador_id' =>$request->ambassador_id,
        //     'age'            =>$request->age,
        //     'passport' =>$new_name

          
        // );

        // AmbassadorGuarantor::create($guarantor_data);

        // return redirect('ambassador_guarantors')->with('success', 'Data Added successfully.');

        return $this->sendResponse(new AmbassadorGuarrantorResource($ambassador_guarantor));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AmbassadorGuarantor  $ambassadorGuarantor
     * @return \Illuminate\Http\Response
     */
    public function show(AmbassadorGuarantor $ambassadorGuarantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AmbassadorGuarantor  $ambassadorGuarantor
     * @return \Illuminate\Http\Response
     */
    public function edit(AmbassadorGuarantor $ambassadorGuarantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AmbassadorGuarantor  $ambassadorGuarantor
     * @return \Illuminate\Http\Response
     */
    public function update(GuarantorRequest $request, $id)
    {
        //
        $ambassadorGuarantor = AmbassadorGuarantor::findOrFail($id);
        $ambassadorGuarantor->name=$request->name;
        $ambassadorGuarantor->age=$request->age;
        $ambassadorGuarantor->phone_number=$request->phone_number;
        $ambassadorGuarantor->gender=$request->gender;
        $ambassadorGuarantor->occupation=$request->occupation;
        $ambassadorGuarantor->office_address=$request->office_address;
        $ambassadorGuarantor->home_address=$request->home_address;
        $ambassadorGuarantor->ambassador_id=$request->ambassador_id;
        // $ambassadorGuarantor->passport=$request->passport;


        if($request->hasFile('passport'))
        {
            $image =$request->file('passport');
            $filename =$image->getClientOriginalName();
            $filesize =$image->getSize();
            $filextension= $image->getClientOriginalExtension();
            $save_image = time().".".$filextension;
            
        }

        $ambassadorGuarantor->update();
    
        return response()->json([
            'success'=>true,
            'message'=>'Guarantor Successfully Updated',
            'data'=>$ambassadorGuarantor
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AmbassadorGuarantor  $ambassadorGuarantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(AmbassadorGuarantor $ambassadorGuarantor, $id)
    {
        //
        if(!$ambassadorGuarantor){
            return response()->json([
                'data'=>"No Guarantor found"
            ],400);
        }

        $ambassador = AmbassadorGuarantor::findOrFail($id);

        if($ambassador->guarantor)
        {
            unlink(public_path('guarantor_image') . $ambassadorGuarantor->guarantor->filename);
        }

        $ambassador->delete();

         return response()->json([
            'data'=>'Guarantor Successfully Deleted'
        ],200);

        // return redirect('ambassadorGuarantor')->with('success', 'Data is successfully deleted');
        
        // delete guarantor image from the public folder
        // foreach($ambassadorGuarantor->images as $ambassadorGuarantor)
        // {
        //     $guarantorImage = public_path('guarantor_image/').$ambassadorGuarantor->filename;
        //     @unlink($guarantorImage);
        // }
        // delete image url from DB
        // $ambassadorGuarantor->images()->delete();

        // delete guarantor from DB
        // $ambassadorGuarantor->delete();

        // return response()->json([
        //     'data'=>'Guarantor Successfully Deleted'
        // ],200);

    }
}
