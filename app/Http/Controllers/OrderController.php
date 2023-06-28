<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        //dd($category);
        return view('backend.orderl.list',compact('orders'));
    }


     
    

    public function dashboard()
    {


    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
                
        $date=strtotime(date("h:i:s"));

        //orderdate
        $today=date('Y-m-d');
        $orders= DB::table('orders')
        ->select('*')
       ->where('orderdate','=',$today) 
        ->get();
        //dd($orders);
        //dd($today);
        return view('backend.orderl.dashboard',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        //$orderitems = Order::where('order_id',$id);
       $orderitems= DB::table('orderdetails')
         ->join('orders', 'orders.id', '=', 'orderdetails.order_id')
            ->join('items', 'items.id', '=', 'orderdetails.item_id')
            ->select( 'orderdetails.qty','items.name' ,'items.price','items.discount','orders.note','orders.voucherno')
            ->where('orderdetails.order_id' ,'=', $id)

            ->get();
            //dd($orderitems);
    
        return view('backend.orderl.orderdetail',compact('order','orderitems'));

    }
       
    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit($id)
    {
        //
                $order=Order::find($id);
        $status="1";
        $order->status=$status;
        $order->save();
        return redirect()->route('backside.orderl.index')->with("successMsg", "Order Confirm Successfully");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
                $order=Order::find($id);
        $status="2";
        $order->status=$status;
        $order->save();
        return redirect()->route('backside.orderl.index')->with("successMsg", "Order Cancel Successfully");
    }
}
