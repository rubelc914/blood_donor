<?php

namespace App\Http\Controllers;

use App\Donors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller
{
    public function index()
    {
        $donor= Donors::select('name','age','weight','gender','blood_group','phone')->get()->toArray();

        return response()->json([
            "status"=>true,
            "donors"=>$donor,
        ]);
    }

    public function createDonor(Request $request){

        $rules = [
            'username'=> 'required|unique:donors,username',
            'name' => 'required',
            'age' => 'required',
            'weight'=>'required',
            'blood_group'=>'required',
            'gender'=>'required',
            'phone'=>'required|unique:donors,phone',
            'address'=>'required',
            'password'=>'required'



        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                "error"=>$validator->errors()
            ]);
        }


        $donor= new Donors();
        $donor->username= $request->username;
        $donor->name = $request->name;
        $donor->age =$request->age;
        $donor->weight =$request->weight;
        $donor->blood_group = $request->blood_group;
        $donor->phone = $request->phone;
        $donor->gender = $request->gender;
        $donor->address = $request->address;
        $donor->password=$request->password;
        $donor->save();

        return response()->json([
		    "status"=>true,
            "message"=>"donors created"
        ]);

    }

 public function loginDonor(Request $request)
 {

    $rules = [
        'username'=> 'required',
        'password'=>'required',



    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()){
        return response()->json([
            'status'=>false,
            "error"=>$validator->errors()
        ]);
    }

    $donor = Donors::where('username', $request->username)->where('password',$request->password)->get()->first();

    if ($donor) {
        return response()->json([
            "message"=>"successfuly login",
        ]);
        }else{
            return response()->json([
                "message"=>"login errors",
            ]);
        }


















 }



}
