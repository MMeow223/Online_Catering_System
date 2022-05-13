<?php

namespace App\Http\Controllers;

use App\Models\CheckoutGoods;
use App\Models\Customer;
use App\Models\Good;
use App\Models\Order;
use App\Models\ShoppingCart;
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

    public function show($order_id){

        $customer_information = Customer::where('user_id', auth()->user()->id)->first();

        $order_details = Order::find($order_id);




        $checkout_items = CheckoutGoods::join('orders', 'checkout_goods.order_id', '=', 'orders.id')
            ->join('goods', 'checkout_goods.good_id', '=', 'goods.id')
            ->join('good_varieties', 'checkout_goods.variety_id', '=', 'good_varieties.id')
            ->select(
                'checkout_goods.id as checkout_id',
                'checkout_goods.quantity as quantity',
                'orders.user_id as ordered_by_user',
                'orders.delivery_time as delivered_at',
                'orders.total_price as order_total_price',
                'orders.is_prepared as is_prepared',
                'orders.is_delivered as is_delivered',
                'goods.id as good_id',
                'goods.good_name as good_name',
                'goods.good_image as good_image',
                'goods.good_price as good_price',
                'good_varieties.variety_name as variety_name',
            )
            ->where('checkout_goods.order_id',$order_id )
            ->get();





        return view('orderstatus.show')
            ->with('order_details', $order_details)
            ->with('checkout_items', $checkout_items)
            ->with('total_price_after_discount', )
            ->with('customer_information',$customer_information)
        ;


    }
}
