<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all();
        $user = User::latest()->get();
        return response()->json($user,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('Create Page User',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8',
            'image' => 'required',
        ]);



        if($validator->fails()){
            return response()->json(['Error'=>$validator->errors(),'user'=>$request->all()],400);
        }

        $input = $request->all();
        $input["password"] = Hash::make($request->input('password'));
        // if (Auth::user() != null) {
        //     $input["created_by"] = Auth::user()->id;
        // }else{
        //     return response()->json("You should be login 400",400);
        // }
        $input["created_by"] = 1;
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        User::create($input);
        return response()->json("Data user are stored Succesfully",200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8',
            'image' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Error'=>$validator->errors(),'user'=>$request->all()],400);
        }

        $input = $request->all();
        // $input["updated_by"] = Auth::user()->id;
        $input["updated_by"] = 1;

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $user->update($input);
        return response()->json("Data User are updated Succesfully",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $input["deleted_by"] = Auth::user()->id;
        $user->update($input);
        return Response()->json('user are deleted',200);
    }

    public function recycleList(){
        $user = DB::select("select * from users where deleted_at IS NOT NULL");

        if($user == null){
            return response()->json('Recycle User are Empty !!',400);
        }

        return response()->json($user,200);
    }

    public function fDelete($id){
        User::onlyTrashed()->find($id)->forceDelete();
        return response()->json("Data User are deleted from recycle",200);
    }

    public function rest($id){
        User::withTrashed()->find($id)->restore();
        return response()->json("Data User are restored from recycle",200);
    }

    public function DeleteAllTrashed(){
        User::onlyTrashed()->forceDelete();
        return response()->json('All  User are Deleted from recycle', 200);
    }
}
