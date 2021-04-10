<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

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


        $customer_name = $request->Input('customer_name');
        $customer_mobile = $request->Input('customer_mobile');
        $customer_address =$request->Input('customer_address');
        $parcel_type = $request->Input('parcel_type');
        $status = $request->Input('status');
        $order_date = $request->Input('order_date');
        $courier_company_name_id   = $request->Input('courier_company_name_id');
        $users_id  = $request->Input('users_id');
        $orderProducts  = $request->Input('orderProduct');

        $order=new Order();
        $order->customer_name=$customer_name;
        $order->customer_mobile=$customer_mobile;
        $order->customer_address=$customer_address;
        $order->parcel_type= $parcel_type;
        $order->status= $status;
        $order->order_date= $order_date;
        $order->courier_company_name_id = $courier_company_name_id ;
        $order->users_id= $users_id;
        $order=$order->save();
        return response()->json([
            'message' => 'Order successfully Store',
            'order' => $order
        ], 201);


        foreach ($orderProducts as $orderProduct)
        {
            $order_product=new OrderProduct();
            $order_product->price=$orderProduct['price'];
            $order_product->size=$orderProduct['size'];
            $order_product->color=$orderProduct['color'];
            $order_product->sku=$orderProduct['sku'];
            $order_product->quantity=$orderProduct['quantity'];
            $order_product->order_id =$orderProduct['order_id '];
            $order_product->product_id=$orderProduct['product_id'];
            $order_product->users_id =$orderProduct['users_id'];
            $order_product= $order_product->save();

            return response()->json([
                'message' => 'Order Product successfully Store',
                'order_product' => $order_product
            ], 201);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
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
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
