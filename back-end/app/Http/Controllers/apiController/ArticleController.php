<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::all();
        $articles = Article::latest()->get();
        return response()->json($articles, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('Create Page', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(["Error" => $validator->errors(), "article" => $request->all()], 400);
        }

        $input = $request->all();

        // if (Auth::user() != null) {
        //     $input["created_by"] = Auth::user()->id;
        // }else{
        //     return response()->json("You should be login 400",400);
        // }

        $input["created_by"] = 1;
        $input['ischecked'] = 0;
        $input['isdraft'] = 0;
        if (isset($request->ischecked))
        {   $input['ischecked'] = 1;}

        if (isset($request->isdraft))
        {   $input['isdraft'] = 1;}

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $article = Article::create($input);
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $input["read_number"] = $this->read_nb($article->read_number);
        $input["last_read_at"] = now();
        $article->update($input);

        return response()->json($article, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json(["Error" => $validator->errors(), "article" => $request->all()], 400);
        }
        $input = $request->all();
        // $input['ischecked'] = 0;
        // $input['isdraft'] = 0;

        if (isset($request->ischecked)){
            $input['ischecked'] = 1;
            return response()->json(["is checked" => $request->ischecked,"isdraft" => $request->ischecked]);
        }
        if (isset($request->isdraft)){
            return response()->json(["is draft" => 1]);
            $input['isdraft'] = 1;
        }
        // $input["updated_by"] = Auth::user()->id;
        $input["updated_by"] = 1;

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $article->update($input);

        return response()->json('Data Article are Successfully updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        $input["deleted_by"] = Auth::user()->id;
        $article->update($input);

        return response()->json('Article Deleted Successfully.', 200);
    }

    /**
     * Display a listing of the recycle.
     *
     * @return \Illuminate\Http\Response
     */
    public function recycle()
    {

        $articles = DB::select('select * from articles where deleted_at IS NOT NULL');
        if ($articles != null) {
            return response()->json(['articles' => $articles], 200);
        } else {
            return response()->json('Recycle Article is empty !!!', 400);
        }
    }

    /**
     * Remove the specified resource from recycle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        Article::onlyTrashed()->find($id)->forceDelete();
        return response()->json('Data Article are deleted from recycle', 200);
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function restore($id)
    {
        Article::withTrashed()->find($id)->restore();
        return response()->json('Data Article are restored from recycle', 200);
    }

    public function DeleteAllTrashed(){
        Article::onlyTrashed()->forceDelete();
        return response()->json('All  Article are Deleted from recycle', 200);
    }

    public function read_nb($n){
        return $n +=1;
    }
}
