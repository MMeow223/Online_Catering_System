<?php

namespace App\Http\Controllers;

use App\Models\CheckoutGoods;
use App\Models\Good;
use App\Models\GoodVariety;
use App\Models\ShoppingCart;
use App\Http\Requests\StoreShoppingCartRequest;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Models\User;
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

        $total_price = $this->calculateTotalPrice();

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
            ->with('selectedItemCount', $selectedItemCount);
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
        return $this->calculateTotalPrice();
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
        return $this->calculateTotalPrice();

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
            ->get();

        $total_price = 0;
        foreach ($cart_items as $cart_item) {
            if ($cart_item->selected) {
                $total_price += $cart_item->good_price * $cart_item->quantity;
            }
        }
        return $total_price;
    }

    //TODO when they click on the checkout button, the selected item will be added into checkout table
    // then these item will display on the checkout page
    // if the order is not placed, the item will not be deleted from the cart
    // if the order is placed, the item will be deleted from the cart
    public function checkoutCartItem(){

        return view('cart.checkout');

        $cart_items = ShoppingCart::join('goods', 'shopping_carts.good_id', '=', 'goods.id')
            ->get();

        // TODO should create an order here first



//        foreach ($cart_items as $cart_item) {
//            CheckoutGoods::insert($cart_items);
//
//            if ($cart_item->selected) {
//                DB::table('checkout_goods')->insert([
//                    'order_id' => $cart_items,
//                    'good_id' => $request->input('description'),
//                    'variety_id' => $image_file_path,
//                    'quantity' => $request->input('price'),
//                    'voucher_code' => $request->input('category_id'),
//                    'created_at' => now(),
//                    'updated_at' => now(),
//                ]);
//            }
//        }



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
