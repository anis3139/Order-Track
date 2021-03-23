<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId=  Auth::user()->id;
        $CategoryAll = Category::where('users_id',$userId)->latest()->get();
        return response()->json([
            'message' => 'Category All Data',
            'CategoryAll' => $CategoryAll
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
        $userId=  Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $Category = Category::create(array_merge(
                    $validator->validated(),
                    ['name' => $request->name],
                    ['users_id' => $userId]
                ));

        return response()->json([
            'message' => 'Category successfully Store',
            'Category' => $Category
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
        $data['category'] = Category::find($id);
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
        $Category = Category::find($id);
        $Category->name = $request->name;
        $result = $Category->save();

        if($result){
            return response()->json([
                'message' => 'Category successfully Update',
                'Category' => $Category
            ], 201);
        }else{
            return response()->json([
                'message' => 'Category Not successfully Update',
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
        $Category = Category::find($id);
        
        $result = $Category->delete();

        if($result){
            return response()->json([
                'message' => 'Category successfully Delete',
            ], 201);
        }else{
            return response()->json([
                'message' => 'Category Not successfully Delete',
            ], 400);
        }
    }
}
