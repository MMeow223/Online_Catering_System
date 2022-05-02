<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\GoodVariety;
use App\Models\ShoppingCart;
use App\Http\Requests\StoreShoppingCartRequest;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->select('shopping_carts.*', 'goods.good_image','goods.good_name','goods.good_price', 'good_varieties.variety_name as good_variety_name', 'users.username as username')
            ->get();

//        dd($cart_items);
        //
        return view('cart.index')
            ->with('cart_items', $cart_items);
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
     * @param  \App\Http\Requests\StoreShoppingCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingCartRequest $request)
    {
        //


        // validate the data
        $this->validate($request, [
            'variety-radio' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

//        User::where('id',Auth::user()->id);
//        dd($request->all());
        DB::table('shopping_carts')->insert([
            'user_id' => Auth::user()->id,
            'good_id' => $request->input('good_id'),
            'quantity' => $request->input('quantity'),
            'variation_id' => $request->input('variety-radio'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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
