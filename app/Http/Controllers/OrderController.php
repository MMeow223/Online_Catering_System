<?php

namespace App\Http\Controllers;

use App\Models\CheckoutGoods;
use App\Models\Customer;
use App\Models\GoodCategory;
use App\Models\GoodVariety;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //link to index page
        return view('orders.index')
            ->with('orders', Order::orderBy('delivery_time','ASC')->paginate(10));
    }

    public function preparation($id)
    {
        // link to show page with good data and category data
        $orders = Order::find($id);
        if($orders->is_prepared){
            $newStatus = 0;
        }else {$newStatus = 1;}
        Order::where('id',$id)->update(['is_prepared'=>$newStatus]);
        return view('orders.index')
            ->with('orders', Order::orderBy('delivery_time','ASC')->paginate(10));
    }

    public function deliver($id)
    {
        // link to show page with good data and category data
        $orders = Order::find($id);
        if($orders->is_prepared){
            if($orders->is_delivered){
                $newStatus = 0;
            }else {$newStatus = 1;}
        }else{$newStatus = $orders->is_delivered;}
        Order::where('id',$id)->update(['is_delivered'=>$newStatus]);
        return view('orders.index')
            ->with('orders', Order::orderBy('delivery_time','ASC')->paginate(10));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //link to create page
        return view('orders.create')
            ->with('categories', GoodCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'delivery_date' => 'required',
            'delivery_time' => 'required',
            'payment_method' => 'required|string|max:255',
        ]);

        //combine delivery date and time
        $delivery_time = $request->input('delivery_date') . ' ' . $request->input('delivery_time') . ':00';

        $cart_items = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
            ->join('users', 'shopping_carts.user_id', '=', 'users.id')
            ->join('good_varieties', 'shopping_carts.variation_id', '=', 'good_varieties.id')
            ->select('shopping_carts.*', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
            ->where('shopping_carts.user_id', auth()->user()->id)
            ->where('shopping_carts.selected', 1)
            ->get();

        $total_price = 0;
        foreach ($cart_items as $cart_item) {
            $total_price += $cart_item->good_price * $cart_item->quantity;
        }



        $customer = Customer::where('user_id',auth()->user()->id)
            ->first();

        ;
        // create new good
        DB::table('orders')->insert([
            'user_id' => auth()->user()->id,
            'delivery_address' => $customer->institution_address,
            'delivery_time' => $delivery_time,
            'total_price' => $total_price,
            'payment_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order_id = DB::getPdo()->lastInsertId();

        //TODO add cart item into checkout items
        foreach ($cart_items as $cart_item) {
            DB::table('checkout_goods')->insert([
                'order_id' => $order_id,
                'good_id' => $cart_item->good_id,
                'variety_id' => $cart_item->variation_id,
                'quantity' => $cart_item->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        //TODO remove cart item from cart
        ShoppingCart::where('user_id', auth()->user()->id)
            ->where('selected', 1)
            ->delete();

        NotificationController::orderStatus();

//        remove the voucher from user voucher table
        DB::table('user_vouchers')->where('user_id', auth()->user()->id)
            ->where('use_status','using')
            ->delete();


        // redirect to index page
        return redirect('/cart')->with('success', 'Order created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // link to show page with good data and category data
        $good = Good::find($id);
        return view('goods.show')
            ->with('good',$good)
            ->with('category', GoodCategory::find($good->good_category_id))
            ->with('varieties', GoodVariety::where('good_id', $id)->orderBy('is_available','DESC')->get());
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // link to edit page with good data and category data
;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,int $id)
    {
        // validate the data

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
