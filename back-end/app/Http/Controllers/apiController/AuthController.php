<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function Register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(["Error" => $validator->errors()],400);
        }
        $input = $request->all();
        $input["password"] = Hash::make($request->input('password'));
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $user = User::create($input);
        return response()->json(["Message"=>"User are Registred Succesfully","Result"=>$user],200);
    }

    public function Login(Request $request){


        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){return response()->json(['Error' => $validator->errors()],400);}
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);
        if (!Auth::attempt($attr)) {return response()->json(["Error" => "Invalid login details"],401);}

        // $token = auth()->user()->createToken('auth_token')->plainTextToken;
        // $user = auth()->user();

        // $respon = [
        //         'status' => 'success',
        //         'msg' => 'Login successfully',
        //         'content' => [
        //             'status_code' => 200,
        //             'access_token' => $token,
        //             'token_type' => 'Bearer',
        //             'user_name' => $user->name,
        //             'user_email' => $user->email,
        //             'user_id' => $user->id,
        //         ]
        //     ];

            return response()->json(['data'=>auth()->user()], 200);
    }
}
