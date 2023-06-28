<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Item;
use App\Brand;
use App\Subcategory;
use Carbon\Carbon;
use App\Order;
class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
       $categories=Category::all();
       $topitems = Item::all()->random(3);
      // $reviewitems=Item::all()->random(3);
       $latestitems=Item::latest()->take(3)->get();
       $discountitems = Item::whereNotNull('discount')->take(3)->get();
       $discountitems = Item::where('discount','>','0')->take(3)->get();
        return view('frontend.index',compact('categories','topitems','latestitems','discountitems'));
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
        $item=Item::find($id);
        return view('frontend.itemdetail',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.


     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function brand($id)
    {
        $branditems= Item::where('brand_id',$id)->get();
        $brand= Brand::find($id);
        //dd($branditems);
        return view('frontend.brand',compact('branditems','brand'));
    }
    public function promotion()
    {

         $promotionitems = Item::whereNotNull('discount')->paginate(3);
       //$promotionitems = Item::where('discount','>','0')->get();
       return view('frontend.promotion',compact('promotionitems'));


    }
    public function cart()
    {
        return view('frontend.cart');

    }
    public function order(Request $request)
    {
            $cart = json_decode($request->data);
            $note=$request->note;

            $orderdate=Carbon::now();
            $voucher = uniqid();
            foreach ($cart as $row) {

                # code...
                $untiprice = $row->price;
                $discount = $row->discount;

                if($discount)
                {
                    $price = $discount;
                }
                else
                {
                    $price=$unitprice;
                }
            }
                $total=$price*$row->qty;

                $status='Order';
                $auth= Auth::user();

                $userid=$auth->id;

                $order = new Order;
                $order->orderdate = $orderdate;
                $order->voucherno = $voucher;
                $order->total = $total;
                $order->note = $note;
                $order->status=$status;
                $order->user_id=$userid;
                $order->save();

            foreach($cart as $value)
            {
                $itemid = $value->id;
                $qty=$value->qty;
                $order->item()->attach($itemid,['qty' => $qty]);
            }
            return response()->json(['status' => 'Order Successfully created!']);
            }
        

        public function ordersuccess(){
            return view('frontend.ordersuccess');
        }



            //dd($note);
    

    public function subcategory($id)
    {
        $subcategoryitems=Item::where('subcategory_id',$id)->get();
        $subcategory=Subcategory::find($id);
        $subcategories=Subcategory::all();
        $latestitems=Item::latest()->take(3)->get();
        return view('frontend.subcategory',compact('subcategoryitems','subcategory','subcategories','latestitems'));
    }
    
   public function search(Request $request)
   {
    $keyword=$request->item;
   //  dd($request->item);
    $searchItem=Item::Where('name','like','%'.$keyword.'%')->get();
 //dd($searchItem);
    return $searchItem;
   }

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
    }
}
