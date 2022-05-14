<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\GoodVariety;
use App\Models\PromotionVoucher;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voucher.index')
            ->with('vouchers', PromotionVoucher::paginate(10));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('voucher.create',);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotionVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'voucher_code' => 'required|unique:promotion_vouchers',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'discount' => 'required|integer|min:1|max:100',
            'price-limit' => 'required|integer',
            'discount-type' => 'required|max:255',
        ]);

        DB::table('promotion_vouchers')->insert([
            'voucher_code' => $request->input('voucher_code'),
            'voucher_name' => $request->input('name'),
            'voucher_description' => $request->input('description'),
            'discount' => $request->input('discount'),
            'price_limit' => $request->input('price-limit'),
            'discount_type' => $request->input('discount-type'),
            'expiry_date' => now()->addDays(14),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // redirect to index page
        return redirect()->route('voucher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function show($voucher_code)
    {
        //
        $voucher = PromotionVoucher::where('voucher_code',$voucher_code)->first();

        return view('voucher.show',)
            ->with('voucher', $voucher);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit($voucher_code)
    {
        //
        $voucher = PromotionVoucher::where('voucher_code',$voucher_code)->first();

        return view('voucher.edit')
            ->with('voucher', $voucher);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotionVoucherRequest  $request
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $voucher_code)
    {
        // validate the data
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'discount' => 'required',
            'price-limit' => 'required',
            'discount-type' => 'required',
        ]);

        DB::table('promotion_vouchers')
            ->where('voucher_code',$voucher_code)
            ->update([
                'voucher_name' => $request->input('name'),
                'voucher_description' => $request->input('description'),
                'discount' => $request->input('discount'),
                'price_limit' => $request->input('price-limit'),
                'discount_type' => $request->input('discount-type'),
                'updated_at' => now(),
            ]);

        return redirect()->route('voucher.show',$voucher_code)->with('success', 'Voucher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy($voucher_code)
    {
        //
        PromotionVoucher::where('voucher_code',$voucher_code)->delete();

        // redirect admin back to the good.index page and prompt a success message
        return redirect()->route('voucher.index')
            ->with('success','Good deleted');
    }

    public function claim_voucher($voucher_id){

        UserVoucher::create([
            'user_id' => auth()->user()->id,
            'voucher_code' => $voucher_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

       return redirect('/')
            ->with('success','Congratulation! You have claimed the voucher!');
    }

}
