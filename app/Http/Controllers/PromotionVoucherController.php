<?php

namespace App\Http\Controllers;

use App\Models\PromotionVoucher;
use App\Http\Requests\StorePromotionVoucherRequest;
use App\Http\Requests\UpdatePromotionVoucherRequest;

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
    public function store(StorePromotionVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionVoucher $promotionVoucher)
    {
        //
        return view('voucher.show',);

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
    public function update(UpdatePromotionVoucherRequest $request, PromotionVoucher $promotionVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromotionVoucher  $promotionVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotionVoucher $promotionVoucher)
    {
        //
    }
}
