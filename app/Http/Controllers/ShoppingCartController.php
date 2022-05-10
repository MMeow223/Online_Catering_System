<?php

namespace App\Http\Controllers;

use App\Models\CheckoutGoods;
use App\Models\Good;
use App\Models\GoodVariety;
use App\Models\PromotionVoucher;
use App\Models\ShoppingCart;
use App\Http\Requests\StoreShoppingCartRequest;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cart_items = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
            ->join('users', 'shopping_carts.user_id', '=', 'users.id')
            ->join('good_varieties', 'shopping_carts.variation_id', '=', 'good_varieties.id')
            ->select('shopping_carts.*', 'goods.id as goods_id', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
            ->get();

        $vouchers = UserVoucher::join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->where('user_id', Auth::id())
            ->select('user_vouchers.*', 'promotion_vouchers.voucher_name as voucher_name', 'promotion_vouchers.discount as discount','promotion_vouchers.price_limit as price_limit')
            ->get();

        $current_using_voucher = UserVoucher::join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->where('user_id', Auth::id())
            ->where('use_status', 'using')
            ->select('user_vouchers.*', 'promotion_vouchers.voucher_name as voucher_name', 'promotion_vouchers.discount as discount','promotion_vouchers.price_limit as price_limit')
            ->first();

        $total_price = $this->calculateTotalPrice();
        $total_price_after_discount = $this->calculateTotalPriceWithDiscount($current_using_voucher);

        $selectedItemCount = 0;
        foreach ($cart_items as $cart_item) {
            if($cart_item->selected == 1){
                $selectedItemCount += 1;
            }
        }
//        dd($selectedItemCount);

        return view('cart.index')
            ->with('cart_items', $cart_items)
            ->with('total_price', $total_price)
            ->with('total_price_after_discount', $total_price_after_discount)
            ->with('selectedItemCount', $selectedItemCount)
            ->with('vouchers',$vouchers)
            ->with('current_using_voucher',$current_using_voucher)
            ->with('products',Good::paginate(40))
            ;
    }
    public function resetVoucher($user_id){
        $user_vouchers = UserVoucher::where('user_id', $user_id)->get();
        foreach ($user_vouchers as $user_voucher){
            $user_voucher->use_status = 'unused';
            $user_voucher->save();
        }

        return redirect()->back();
    }

    public function updateSelected($item_id)
    {
        $cart_item = ShoppingCart::find($item_id);
        $cart_item->selected = !($cart_item->selected);
        $cart_item->save();
        return redirect()->route('cart.index');
    }

    public function updateIncreaseQuantity($item_id)
    {
        $cart_item = ShoppingCart::find($item_id);
        $cart_item->quantity += 1;
        $cart_item->save();

        return [$this->calculateTotalPrice(),$this->calculateTotalPriceWithDiscount(null)];
    }

    //TODO if the quantity is 0, delete the item from the cart
    public function updateDecreaseQuantity($item_id)
    {

        $cart_item = ShoppingCart::find($item_id);

        if($cart_item->quantity > 1)
        {
            $cart_item->quantity -= 1;
            $cart_item->save();
        }
        else
        {
            $cart_item->delete();
        }
        return [$this->calculateTotalPrice(),$this->calculateTotalPriceWithDiscount(null)];

    }

    public function updateSelectedVoucher($voucher_code)
    {

        $reset_voucher = UserVoucher::where('user_id', auth()->user()->id)
        ->where('use_status', '=', 'using')
        ->get();

        foreach ($reset_voucher as $reset_voucher_item) {
            $reset_voucher_item->use_status = 'unused';
            $reset_voucher_item->save();
        }

        $voucher = UserVoucher::where('user_id', auth()->user()->id)
            ->where('voucher_code', $voucher_code)
            ->first();

        $voucher->use_status = 'using';
        $voucher->save();

        return redirect()->route('cart.index');

    }
    public function calculateCartItemPrice($item_id)
    {
        $cart_item = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
            ->join('users', 'shopping_carts.user_id', '=', 'users.id')
            ->join('good_varieties', 'shopping_carts.variation_id', '=', 'good_varieties.id')
            ->select('shopping_carts.*', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
            ->where('shopping_carts.id', $item_id)
            ->first();


        return 'RM' . number_format((float)($cart_item->quantity * $cart_item->good_price), 2, '.', '');
    }

    public function calculateTotalPrice(){
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

        return $total_price;
    }

    public function calculateTotalPriceWithDiscount($current_using_voucher){

        if($current_using_voucher == null) {
            $current_using_voucher = UserVoucher::join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
                ->where('user_id', Auth::id())
                ->where('use_status', 'using')
                ->select('user_vouchers.*', 'promotion_vouchers.voucher_name as voucher_name', 'promotion_vouchers.discount as discount','promotion_vouchers.price_limit as price_limit')
                ->first();
        }

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

        if($current_using_voucher != null) {

            $discount_amount = (($total_price/100) * $current_using_voucher->discount);

            if($discount_amount > $current_using_voucher->price_limit){
                $discount_amount = $current_using_voucher->price_limit;
            }

            $total_price -= $discount_amount;
        }

        return $total_price;
    }

    public function checkoutCartItem(){

        $customer_information = User::join('customers','users.owner_id','=','customers.id')
            ->select('customers.*','users.username')
            ->where('users.id',auth()->user()->id)
            ->first();



        $selected_cart_items = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
            ->join('users', 'shopping_carts.user_id', '=', 'users.id')
            ->join('good_varieties', 'shopping_carts.variation_id', '=', 'good_varieties.id')
            ->select('shopping_carts.*', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
            ->where('shopping_carts.user_id', auth()->user()->id)
            ->where('shopping_carts.selected', 1)
            ->get();

        $vouchers = UserVoucher::join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->where('user_id', Auth::id())
            ->select('user_vouchers.*', 'promotion_vouchers.voucher_name as voucher_name', 'promotion_vouchers.discount as discount','promotion_vouchers.price_limit as price_limit')
            ->get();

        $current_using_voucher = UserVoucher::join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->where('user_id', Auth::id())
            ->where('use_status', 'using')
            ->select('user_vouchers.*', 'promotion_vouchers.voucher_name as voucher_name', 'promotion_vouchers.discount as discount','promotion_vouchers.price_limit as price_limit')
            ->first();

        $total_price = $this->calculateTotalPrice();
        $total_price_after_discount = $this->calculateTotalPriceWithDiscount($current_using_voucher);

        $selectedItemCount = 0;
        foreach ($selected_cart_items as $cart_item) {
            if($cart_item->selected == 1){
                $selectedItemCount += 1;
            }
        }


        if($current_using_voucher == null){
            $discount = 0;
            $actual_discount_amount = $total_price;

        }
        else{

            $actual_discount_amount = $current_using_voucher->discount * $total_price / 100;

            if($actual_discount_amount >= $current_using_voucher->price_limit){
                $actual_discount_amount = $current_using_voucher->price_limit;
            }
            $discount = $current_using_voucher->discount;

        }


        return view('cart.checkout')
            ->with('selected_cart_items', $selected_cart_items)
            ->with('total_price', $total_price)
            ->with('total_price_after_discount', $total_price_after_discount)
            ->with('selectedItemCount', $selectedItemCount)
            ->with('vouchers',$vouchers)
            ->with('current_using_voucher',$current_using_voucher)
            ->with('products',Good::paginate(40))
            ->with('actual_discount_amount',$actual_discount_amount)
            ->with('customer_information',$customer_information)
            ->with('discount',$discount);
            ;


        // TODO should create an order here first

    }

    public function placeOrder(Request $request){

        dd($request->all());



    }
//
//    public function calculateCartTotalPrice(){
//        //
//        $cart_items = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
//            ->join('users', 'shopping_carts.user_id', '=', 'users.id')
//            ->join('good_varieties', 'shopping_carts.variation_id', '=', 'good_varieties.id')
//            ->select('shopping_carts.*', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
//            ->get();
//
//        $total_price = 0;
//        foreach ($cart_items as $cart_item) {
//            $total_price += $cart_item->good_price * $cart_item->quantity;
//        }
//
//        return $total_price;
//    }

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
     * @param  \App\Http\Requests\StoreShoppingCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingCartRequest $request)
    {
        // validate the data
        $this->validate($request, [
            'variety-radio' => 'required',
            'quantity' => 'required|numeric|min:1',
            'good_id' => 'required',
        ]);

        $checkCartItemExist = ShoppingCart::where('user_id', Auth::user()->id)
            ->where('good_id', $request->input('good_id'))
            ->where('variation_id', $request->input('variety-radio'))
            ->first();


        if($checkCartItemExist != null){
            $checkCartItemExist->quantity = $checkCartItemExist->quantity + $request->input('quantity');
            $checkCartItemExist->save();
        }
        else{
            DB::table('shopping_carts')->insert([
                'user_id' => Auth::user()->id,
                'good_id' => $request->input('good_id'),
                'quantity' => $request->input('quantity'),
                'variation_id' => $request->input('variety-radio'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // redirect to index page
        return redirect()->back()
            ->with('success', 'Item added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShoppingCartRequest  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingCartRequest $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        dd($id);
        // remove the good
        ShoppingCart::destroy($id);

        // redirect admin back to the good.index page and prompt a success message
        return redirect()->route('cart.index')
            ->with('success','Cart Item deleted');
    }
}
