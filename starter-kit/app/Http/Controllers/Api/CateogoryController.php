<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cateogory;
use Validator;

class CateogoryController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryAll = Cateogory::latest()->get();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $Cateogory = Cateogory::create(array_merge(
                    $validator->validated(),
                    ['name' => $request->name],
                    ['users_id' => $request->users_id]
                ));

        return response()->json([
            'message' => 'Cateogory successfully Store',
            'Cateogory' => $Cateogory
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
        $data['category'] = Cateogory::find($id);
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
        $Cateogory = Cateogory::find($id);
        $Cateogory->name = $request->name;
        $result = $Cateogory->save();

        if($result){
            return response()->json([
                'message' => 'Cateogory successfully Update',
                'Cateogory' => $Cateogory
            ], 201);
        }else{
            return response()->json([
                'message' => 'Cateogory Not successfully Update',
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
        $Cateogory = Cateogory::find($id);
        
        $result = $Cateogory->delete();

        if($result){
            return response()->json([
                'message' => 'Cateogory successfully Delete',
            ], 201);
        }else{
            return response()->json([
                'message' => 'Cateogory Not successfully Delete',
            ], 400);
        }
    }
}
