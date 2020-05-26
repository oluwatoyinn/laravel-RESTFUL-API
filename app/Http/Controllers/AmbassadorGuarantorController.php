<?php

namespace App\Http\Controllers;

use App\AmbassadorGuarantor;
use Illuminate\Http\Request;

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
        return $ambassador_guarantors;

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

        $ambassador_guarantors = new AmbassadorGuarantor;

        $ambassador_guarantors->name =$request->name;
        $ambassador_guarantors->gender =$request->gender;
        $ambassador_guarantors->age =$request->age;
        $ambassador_guarantors->phone_number =$request->phone_number;
        $ambassador_guarantors->occupation =$request->occupation;
        $ambassador_guarantors->office_address =$request->office_address;
        $ambassador_guarantors->home_address =$request->home_address; 
        $ambassador_guarantors->ambassador_id =$request->ambassador_id;


        if($request->hasFile('passport'))
        {
            $image =$request->file('passport');
            $filename =$image->getClientOriginalName();
            $filesize =$image->getSize();
            $filextension= $image->getClientOriginalExtension();
            $save_image = time().".".$filextension;

        }

        $ambassador_guarantors->passport = $save_image;

        $ambassador_guarantors->save();

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

        return $this->sendResponse($ambassador_guarantors);

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
    public function update(Request $request, AmbassadorGuarantor $ambassadorGuarantor)
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

        $ambassadorGuarantor->name=$request->name;
        $ambassadorGuarantor->age=$request->age;
        $ambassadorGuarantor->passport=$request->passport;
        $ambassadorGuarantor->phone_number=$request->phone_number;
        $ambassadorGuarantor->gender=$request->gender;
        $ambassadorGuarantor->occupation=$request->occupation;
        $ambassadorGuarantor->office_address=$request->office_address;
        $ambassadorGuarantor->home_address=$request->home_address;
        $ambassadorGuarantor->ambassador_id=$request->ambassador_id;

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

        if($ambassador->ambassador_guarantor)
        {
            unlink(public_path('guarantor_image') . $ambassadorGuarantor->ambassador_guarantor->filename);
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
