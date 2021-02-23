<?php

namespace App\Http\Controllers;

use App\donors;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        return 'donor list';
    }

    public function createDonor(Request $request){

        $rules = [
            'name' => 'required',
            'age' => 'required',
            'weight'=>'required',
            'blood_group'=>'blood_group',
            'gender'=>'gender',
            'phone'=>'phone',


        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                "error"=>$validator->error
            ]);
        }


        $donor= new donors();
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
