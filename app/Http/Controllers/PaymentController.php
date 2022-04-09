<?php

namespace App\Http\Controllers;

use App\Models\GoodCategory;
use App\Models\GoodVariety;
use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
        return view('payment.index')
            ->with('payment', Payment::orderBy('created_at','DESC')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //link to create page
    }

    /**
     * Store a newly created resource in storage.
     *$table->id()->unique();

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'payment_method' => 'required|max:255',
            'account_number' => 'required|numeric',
            'transaction_id' => 'required|integer',
            'total_amount' => 'required|numeric',
        ]);

        // create new good
//        $table->timestamps();
//        $table->string('payment_method');
//        $table->string('account_number')->nullable();
//        $table->string('transaction_id')->nullable();
//        $table->string('total_amount');
        DB::table('payment')->insert([
            'payment_method' => $request->input('payment_method'),
            'account_number' => $request->input('account_number'),
            'transaction_id' => $request->input('transaction_id'),
            'total_amount' => $request->input('total_amount'),
        ]);


        // redirect to index page
        return redirect()->route('payment.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        // link to show page with good data and category data
//        $good = Good::find($id);
//        return view('payment.show')
//            ->with('payment',$payment);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
