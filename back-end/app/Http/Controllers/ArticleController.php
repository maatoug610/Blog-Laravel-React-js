<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Article;
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
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',

        ]);

        if ($validator->fails()) {

            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $input = $request->all();

        if(Auth::user() != null){
        $input["created_by"] = Auth::user()->id;
        }else{
            return response()->json("You should be login 400",400);
        }


        if (isset($request->ischecked)) {
            $input['ischecked'] = 1;
        } else {
            $input['ischecked'] = 0;
        }

        if (isset($request->isdraft)) {
            $input['isdraft'] = 1;
        } else {
            $input['isdraft'] = 0;
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Article::create($input);

        return redirect('/article');
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
        return view('article.edit', compact('article'));
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

            return  redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();

        if (isset($request->ischecked)) {
            $input['ischecked'] = 1;
        } else {
            $input['ischecked'] = 0;
        }

        if (isset($request->isdraft)) {
            $input['isdraft'] = 1;
        } else {
            $input['isdraft'] = 0;
        }

        $input["updated_by"] = Auth::user()->id;
        if ($image = $request->file('image')) {

            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $article->update($input);

        return redirect('/article');
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
        return redirect()->back()->with('Good');
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
            return view('article.Recycle', ['articles' => $articles]);
        } else {
            return view('article.recycleError', ['articles' => $articles]);
        }
    }


    /**
     * Remove the specified resource from recycle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fDelete($id)
    {
        Article::onlyTrashed()->find($id)->forceDelete();
        return redirect('/article');
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function restore($id)
    {
        Article::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function DeleteAllTrashed(){
        Article::onlyTrashed()->forceDelete();
        return redirect()->back();
    }

    public function read_nb($n){
        return $n +=1;
    }
}
