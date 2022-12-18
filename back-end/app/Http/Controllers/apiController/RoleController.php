<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles = Role::all();
        $roles = Role::latest()->get();
        return response()->json($roles,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('Create Page Role',200);
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
            'title' => 'required',
            'description' => 'required',
            'isdraft' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'Error'=> $validator->errors(),
                'role' => $request->all(),
            ],400);
        }

        $input = $request->all();
        if (Auth::user() != null) {
            $input["created_by"] = Auth::user()->id;
        }else{
            return response()->json("You should be login 400",400);
        }
        if(isset($request->isdraft)){
            $input['isdraft'] = 1;
        }else{
            $input['isdraft'] = 0;
        }

        $roles = Role::create($input);
        return response()->json(['message'=>"Data are stored succesfully",'Data'=>$roles],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Role::find($id);
        return response()->json($roles,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::find($id);
        return response()->json($roles,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'isdraft' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Error'=>$validator->errors(),'role'=>$request->all()],400);
        }

        $input = $request->all();
        $input["updated_by"] = Auth::user()->id + Auth::user()->name;
        if(isset($request->isdraft)){
            $input['isdraft'] = 1;
        }else{
            $input['isdraft'] = 0;
        }

        $role->update($input);
        return response()->json("Data Role are updated Succesfully",200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $input["deleted_by"] = Auth::user()->id;
        $role->update($input);
        return response()->json("Role Data are deleted Succesfully",200);
    }

    public function recycleList(){
        $role = DB::select("select * from roles where deleted_at IS NOT NULL");

        if($role == null){
            return response()->json('Recycle Role are Empty !!',400);
        }

        return response()->json($role,200);
    }

    public function fDelete($id){
        Role::onlyTrashed()->find($id)->forceDelete();
        return response()->json("Data Role are deleted from recycle",200);
    }

    public function rest($id){
        Role::withTrashed()->find($id)->restore();
        return response()->json("Data Role are restored from recycle",200);
    }

    public function DeleteAllTrashed(){
        Role::onlyTrashed()->forceDelete();
        return response()->json('All  Role are Deleted from recycle', 200);
    }
}
