<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Vendor;
use Validator;

class ProductController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Product = Product::with(['category','brand','vendor'])->get();
        return response()->json([
            'message' => 'Product All Data',
            'Product' => $Product
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'users_id' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'vendor_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $Product = Product::create(array_merge(
                    $validator->validated(),
                    ['name' => $request->name],
                    ['users_id' => $request->users_id],
                    ['brand_id' => $request->brand_id],
                    ['category_id' => $request->category_id], 
                    ['vendor_id' => $request->vendor_id],
                ));

        return response()->json([
            'message' => 'successfully Store',
            'Product' => $Product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();
        $data['brand'] = Brand::all();
        $data['vendor'] = Vendor::all();
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

   

        $Product = Product::find($id);
        $Product->name = $request->name;
        $Product->brand_id = $request->brand_id;
        $Product->category_id = $request->category_id;
        $Product->vendor_id = $request->vendor_id;
        $result = $Product->save();

        if($result){
            return response()->json([
                'message' => 'successfully Update',
                'Product' => $Product
            ], 201);
        }else{
            return response()->json([
                'message' => 'Not successfully Update',
            ], 400);
        }
                  

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
        
        $result = $Product->delete();

        if($result){
            return response()->json([
                'message' => 'successfully Delete',
            ], 201);
        }else{
            return response()->json([
                'message' => 'Not successfully Delete',
            ], 400);
        }
    }
}
