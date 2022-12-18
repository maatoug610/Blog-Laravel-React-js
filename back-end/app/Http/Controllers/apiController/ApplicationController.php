<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $applications = Application::all();
        $applications = Application::latest()->get();
        return response()->json($applications,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json("Create Product Page");
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
            'content' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Error'=>$validator->errors(),'application'=>$request->all()],400);
        }
        $input = $request->all();

        if (Auth::user() != null) {
            $input["created_by"] = Auth::user()->id;
        }else{
            return response()->json("You should be login 400",400);
        }


        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $application = Application::create($input);
        return response()->json($application,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applications = Application::find($id);
        return response()->json($applications,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applications = Application::find($id);
        return response()->json($applications,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(["Error"=>$validator->errors(),"application"=>$request->all()],400);
        }
        $input = $request->all();
        $input["updated_by"] = Auth::user()->id;

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $application->update($input);

        return response()->json('Data Article are Successfully updated',200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();
        $input["deleted_by"] = Auth::user()->id;
        $application->update($input);
        return response()->json("Application deleted Successfully!!",200);
    }

    public function recycleList(){

        $application = DB::select("select * from applications where deleted_at IS NOT NULL");

        if($application == null){
            return response()->json("Recycle is empty",400);
        }

        return response()->json($application,200);
    }

    public function forceDelete($id){
        Application::onlyTrashed()->find($id)->forceDelete();
        return response()->json("Data Application are deleted from recycle",200);
    }

    public function restore($id){
        Application::withTrashed()->find($id)->restore();
        return response()->json("Data Application are Restored");
    }

    public function DeleteAllTrashed(){
        Application::onlyTrashed()->forceDelete();
        return response()->json('All  Application are Deleted from recycle', 200);
    }
}
