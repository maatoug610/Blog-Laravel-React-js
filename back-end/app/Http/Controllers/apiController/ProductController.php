<?php

namespace App\Http\Controllers\apiController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::latest()->get();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('Create Page Product', 200);
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
        ]);

        if ($validator->fails()) {
            return response()->json(["Error" => $validator->errors(), "product" => $request->all()], 400);
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

        $product = Product::create($input);
        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        return response()->json($products, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return response()->json($products, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["Error" => $validator->errors(), "product" => $request->all()],400);
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

        $product->update($input);

        return response()->json("Data Product are Successfully updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $input["deleted_by"] = Auth::user()->id;
        $product->update($input);
        return response()->json("Product Deleted Successfully", 200);
    }

    public function recycleList()
    {
        $products = DB::select('select * from products where deleted_at IS NOT NULL');

        if ($products == null) {
            return response()->json('Recycle is empty !!', 400);
        }

        return response()->json($products, 200);

    }

    public function forceDelete($id)
    {
        Product::onlyTrashed()->find($id)->forceDelete();
        return response()->json("Data Product are deleted from recycle");
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return response()->json("Data Product are restored from recycle");
    }

    public function DeleteAllTrashed(){
        Product::onlyTrashed()->forceDelete();
        return response()->json('All  Product are Deleted from recycle', 200);
    }
}
