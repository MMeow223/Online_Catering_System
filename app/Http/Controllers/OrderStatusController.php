<?php

namespace App\Http\Controllers;

use App\Models\CheckoutGoods;
use App\Models\Customer;
use App\Models\Good;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    public function index(){
        $nowstr = date('Y-m-d H:i:s');
        $now = date('Y-m-d H:i:s', strtotime($nowstr. ' -5 hours'));
        $checkout = CheckoutGoods::join('orders', 'checkout_goods.order_id', '=', 'orders.id')
            ->join('goods', 'checkout_goods.good_id', '=', 'goods.id')
            ->join('good_varieties', 'checkout_goods.variety_id', '=', 'good_varieties.id')
            ->select('checkout_goods.*','orders.*','goods.*','good_varieties.*')
            ->get();

        return view('orderstatus.index')
            ->with('checkout', $checkout)
            ->with('orders', Order::orderBy('orders.delivery_time','ASC')->where('orders.delivery_time' , '>=' , $now)->paginate(5));

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::orderBy('orders.delivery_time','ASC')->find($id);
        $checkout = CheckoutGoods::join('orders', 'checkout_goods.order_id', '=', 'orders.id')
            ->join('goods', 'checkout_goods.good_id', '=', 'goods.id')
            ->join('good_varieties', 'checkout_goods.variety_id', '=', 'good_varieties.id')
            ->select('checkout_goods.*','orders.*','goods.*','good_varieties.*')
            ->get();
        return view('orderstatus.show')
            ->with('checkout',$checkout)
            ->with('orders',$order);


    }
}
