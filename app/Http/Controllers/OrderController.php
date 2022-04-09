<?php

namespace App\Http\Controllers;

use App\Models\GoodCategory;
use App\Models\GoodVariety;
use App\Models\Order;
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
            ->with('orders', Order::orderBy('is_delivered','ASC')->paginate(10));
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
            'user_id' => 'required|max:255',
            'delivery_time' => 'required|datetime',
            'total_price' => 'required|max:255',
            'payment_id' => 'required|integer',
            'is_prepared' => 'required|boolean',
            'is_delivered' => 'required|boolean',

        ]);

        // create new good
        DB::table('payments')->insert([
            'good_name' => $request->input('name'),
            'good_description' => $request->input('description'),
            'good_image' => $image_file_path,
            'good_price' => $request->input('price'),
            'good_category_id' => $request->input('category_id'),
            'is_warm' => $request->input('food_type_option'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // create the variety of the good
        GoodVarietyController::staticStoreGoodVariety($request);

        // redirect to index page
        return redirect()->route('orders.index');

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
