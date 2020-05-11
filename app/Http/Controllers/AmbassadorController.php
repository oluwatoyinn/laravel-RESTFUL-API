<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ambassador;
use App\Http\Resources\AmbassadorResource;
// use App\Http\Resources\Ambassador as AmbassadorResource;

class AmbassadorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get ambassador
        $ambassadors = Ambassador::paginate(30);
        //return number of ambassador asa aresource
        return $this->sendResponse(AmbassadorResource::collection($ambassadors)); 
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
        
        $ambassador = $request->isMethod('put') ? Ambassador::findOrFail
        ($request->ambassador_id) : new Ambassador;
      

        $ambassador->id = $request->input('ambassador_id');
        $ambassador->name = $request->input('name');
        $ambassador->address = $request->input('address');
        $ambassador->email = $request->input('email');
        $ambassador->phone_number = $request->input('phone_number');
        $ambassador->guarantor = $request->input('guarantor');
        $ambassador->location = $request->input('location');

        if($ambassador->save()){
            return $this->sendResponse(new AmbassadorResource($ambassador));
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //GET A SINGLE AMBASSADOR
        $ambassador = Ambassador::findOrFail($id);
         //RETURN A SINGLE AMBASSADOR AS A RESOURCE
         return $this->sendResponse(new AmbassadorResource($ambassador));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ambassador =Ambassador::findOrFail($id);
        $ambassador->name = $request->name;
        $ambassador->address = $request->address;
        $ambassador->email = $request->email;
        $ambassador->phone_number = $request->phone_number;
        $ambassador->guarantor = $request->guarantor;
        $ambassador->location = $request->location;
        $ambassador->save();
        
        return response()->json($ambassador);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $ambassador = Ambassador::findOrFail($id );
         if($ambassador) {
            $ambassador->delete();
            return $this->deleteResponse(new AmbassadorResource($ambassador));
         } 
    }
}
