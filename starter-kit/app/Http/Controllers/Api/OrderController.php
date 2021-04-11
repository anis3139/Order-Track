<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with(['orderProducts', 'orderProducts.product'])->latest()->get();
        return response()->json([
            'message' => 'Order Data',
            'order' => $order
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



        $validator = validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_mobile' => 'required|| min:10|| max:18',
            'customer_address' => 'required',
            'customer_name' => 'required',
            'status' => 'required',
            'users_id' => 'required',
            'orderProducts' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $customer_name = $request->Input('customer_name');
        $customer_mobile = $request->Input('customer_mobile');
        $customer_address =$request->Input('customer_address');
        $parcel_type = $request->Input('parcel_type');
        $status = $request->Input('status');
        $order_date = $request->Input('order_date');
        $courier_company_name_id= $request->Input('courier_company_name_id');

        $users_id  = $request->Input('users_id');
        $orderProducts  = $request->Input('orderProducts');






        $order = Order::create(array_merge(
            $validator->validated(),
            ['customer_name'=>$customer_name],
            ['customer_mobile'=>$customer_mobile],
            ['customer_address'=>$customer_address],
            ['parcel_type'=> $parcel_type],
            ['status'=> $status],
            ['order_date'=> $order_date],
            ['courier_company_name_id' => $courier_company_name_id],
            ['users_id'=> $users_id]
        ));



        foreach ($orderProducts as $key=> $orderProduct)
        {


            $order_product=new OrderProduct();
            $order_product->price=$orderProduct['price'];
            $order_product->size=$orderProduct['size'];
            $order_product->color=$orderProduct['color'];
            $order_product->sku=$orderProduct['sku'];
            $order_product->quantity=$orderProduct['quantity'];
            $order_product->order_id =$order->id;
            $order_product->product_id=$orderProduct['product_id'];
            $order_product->users_id =$orderProduct['users_id'];
            $order_product= $order_product->save();


        }

        return response()->json([
            'message' => 'Order  successfully Store',
            'order' => $order,
            'order_product' => $order_product
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Order::with(['orderProducts', 'orderProducts.product'])->find($id);
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $validator = validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_mobile' => 'required|| min:10|| max:18',
            'customer_address' => 'required',
            'customer_name' => 'required',
            'status' => 'required',
            'users_id' => 'required',
            'orderProducts' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $order = Order::find($id);
        $order->customer_name = $request->customer_name;
        $order->customer_mobile = $request->customer_mobile;
        $order->customer_address = $request->customer_address;
        $order->customer_name = $request->customer_name;
        $order->status = $request->status;
        $order->users_id = $request->users_id;
        $order->parcel_type = $request->parcel_type;
        $result = $order->save();


        if($result){
            return response()->json([
                'message' => 'Order successfully Update',
                'Order' => $order
            ], 201);
        }else{
            return response()->json([
                'message' => 'Order Not successfully Update',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $result = $order->delete();

        if($result){
            return response()->json([
                'message' => 'Order successfully Delete',
            ], 201);
        }else{
            return response()->json([
                'message' => 'Order Not successfully Delete',
            ], 400);
        }
    }
}


