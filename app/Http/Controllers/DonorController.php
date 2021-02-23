<?php

namespace App\Http\Controllers;

use App\donors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller
{
    public function index()
    {
        return 'donor list';
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


        $donor= new donors();
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
            "message"=>"donors created"
        ]);

    }
}
