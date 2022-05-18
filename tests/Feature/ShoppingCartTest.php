<?php

namespace Tests\Feature;

use App\Http\Controllers\ShoppingCartController;
use App\Models\CheckoutGoods;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Chrome;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    /**
     * Open the url as a user and verify the HTTP Code response
     *
     * @return void
     */
    public function test_shopping_cart_url_connectivity()
    {
        $response = $this->actingAs($this->getUser())
            ->get('/cart');

        $response->assertStatus(200);
    }

    public function test_fetch_cart_items()
    {
        DB::table('shopping_carts')->delete();

        $user = $this->getUser();

        $response = $this->actingAs($user)
            ->get('/cart');

        $response->assertViewHas('cart_items', function ($cart_items) {
            return $cart_items->count() == 0;
        });

        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        $response = $this->actingAs($user)
            ->get('/cart');

        $response->assertViewHas('cart_items', function ($cart_items) {
            return $cart_items->count() == 1;
        });
    }

    public function test_edit_cart_items()
    {
        DB::table('shopping_carts')->delete();
        $this->actingAs($this->getUser());
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);
        $cart_item_id = ShoppingCart::where('good_id', 1)->first()->id;

        $this->assertEquals(1, ShoppingCart::find($cart_item_id)->quantity);
        (new ShoppingCartController)->updateIncreaseQuantity($cart_item_id);
        $this->assertEquals(2, ShoppingCart::find($cart_item_id)->quantity);
        (new ShoppingCartController)->updateDecreaseQuantity($cart_item_id);
        $this->assertEquals(1, ShoppingCart::find($cart_item_id)->quantity);


    }

    public function test_delete_item_from_cart()
    {
        DB::table('shopping_carts')->delete();
        $user = $this->getUser();
        $this->actingAs($user);
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        $response = $this->get('/cart');

        $response->assertViewHas('cart_items', function ($cart_items) {
            return $cart_items->count() == 1;
        });

        (new ShoppingCartController)->destroy(ShoppingCart::where('good_id', 1)->first()->id);

        $response = $this->get('/cart');

        $response->assertViewHas('cart_items', function ($cart_items) {
            return $cart_items->count() == 0;
        });

    }

    public function test_select_item_for_checkout()
    {
        DB::table('shopping_carts')->delete();
        $user = $this->getUser();
        $this->actingAs($user);
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        $this->assertEquals(false, ShoppingCart::where('good_id', 1)->first()->selected);


        (new ShoppingCartController)->updateSelected(ShoppingCart::where('good_id', 1)->first()->id);

        $this->assertEquals(true, ShoppingCart::where('good_id', 1)->first()->selected);

    }

    public function test_select_voucher()
    {
        // reset table
        DB::table('user_vouchers')->delete();
        DB::table('shopping_carts')->delete();

        // declare user
        $this->actingAs($this->getUser());

        // add item to cart
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        // elect item in cart
        (new ShoppingCartController)->updateSelected(ShoppingCart::where('good_id', 1)->first()->id);

        // check price before apply voucher
        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) {
            return $total_price_after_discount == 10;
        });

        // add voucher
        DB::table('user_vouchers')->insert(
            ['created_at' => now(), 'updated_at' => now(), 'user_id' => 2, 'voucher_code' => 'VOUCHER1']
        );

        // check use state of voucher
        $this->assertEquals('unused', UserVoucher::where('voucher_code', 'VOUCHER1')->first()->use_status);

        // apply voucher
        (new ShoppingCartController)->updateSelectedVoucher('VOUCHER1');

        // check use state of voucher
        $this->assertEquals('using', UserVoucher::where('voucher_code', 'VOUCHER1')->first()->use_status);

        // check price after apply voucher
        $voucher_discount = DB::table('user_vouchers')
            ->join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->select('promotion_vouchers.discount')
            ->first()
            ->discount;


        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) use ($voucher_discount) {

            return str($total_price_after_discount) == str((10 / 100) * (100 - $voucher_discount));
        });
    }

    public function test_show_total_price()
    {
        // reset table
        DB::table('user_vouchers')->delete();
        DB::table('shopping_carts')->delete();

        // declare user
        $this->actingAs($this->getUser());

        // add item to cart
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        // check price before select item
        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) {
            return $total_price_after_discount == 0;
        });

        // select item in cart
        (new ShoppingCartController)->updateSelected(ShoppingCart::where('good_id', 1)->first()->id);

        // check price after select item & before add item quantity
        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) {
            return $total_price_after_discount == 10;
        });

        (new ShoppingCartController)->updateIncreaseQuantity(ShoppingCart::where('good_id', 1)->first()->id);

        // check price after add one item quantity & before add apply voucher
        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) {
            return $total_price_after_discount == 20;
        });

        // add voucher
        DB::table('user_vouchers')->insert(
            ['created_at' => now(), 'updated_at' => now(), 'user_id' => 2, 'voucher_code' => 'VOUCHER1']
        );

        // check use state of voucher
        $this->assertEquals('unused', UserVoucher::where('voucher_code', 'VOUCHER1')->first()->use_status);

        // apply voucher
        (new ShoppingCartController)->updateSelectedVoucher('VOUCHER1');

        // check use state of voucher
        $this->assertEquals('using', UserVoucher::where('voucher_code', 'VOUCHER1')->first()->use_status);

        // check price after apply voucher
        $voucher_discount = DB::table('user_vouchers')
            ->join('promotion_vouchers', 'user_vouchers.voucher_code', '=', 'promotion_vouchers.voucher_code')
            ->select('promotion_vouchers.discount')
            ->first()
            ->discount;

        $response = $this->get('/cart');
        $response->assertViewHas('total_price_after_discount', function ($total_price_after_discount) use ($voucher_discount) {

            return str($total_price_after_discount) == str((20 / 100) * (100 - $voucher_discount));
        });

    }

    public function test_check_out_selected_item()
    {
        // reset table
        DB::table('shopping_carts')->delete();
        DB::table('checkout_goods')->delete();

        // declare user
        $this->actingAs($this->getUser());

        // add item to cart
        $this->post(route('cart.store'), [
            'good_id' => 1,
            'variety-radio' => 1,
            'quantity' => 1
        ]);

        (new ShoppingCartController)->updateSelected(ShoppingCart::where('good_id', 1)->first()->id);

        // check the check out item table before check out

        // check price after add one item quantity & before add apply voucher
        $response = $this->get('/checkout');
        $response->assertViewHas('selected_cart_items', function ($selected_cart_items) {
            return $selected_cart_items->count() == 1;
        });

        $this->assertEquals(0, CheckoutGoods::count());

    }

    public function test_advertise_product_at_bottom()
    {
        // declare user
        $this->actingAs($this->getUser());

        $response = $this->get('/cart');
        $response->assertViewHas('products', function ($products) {
            return count($products) > 0;
        });

        $this->assertEquals(0, CheckoutGoods::count());

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return User::where('is_admin', 0)->first();
    }
}
