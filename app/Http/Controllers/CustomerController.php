<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Auth::user()->customer()->first();
        return view('customer.show',['customer'=>$customer]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $customer = Auth::user()->customer()->first();
        return view('customer.edit',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $customer = Auth::user()->customer()->first();
        // validate the data
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'institutional_name' => 'max:255',
            'institutional_address' => 'max:255',
            'phone' => 'regex:/^([0-9\s\-\+\(\)\.]*)$/',
        ]);

        // update user
        $query = DB::table('users')
            ->where('id',$id)
            ->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'updated_at' => now(),
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);

        $query2 = DB::table('customers')
            ->where('id',$id)
            ->update([
                'institution_name' => $request->input('institutional_name'),
                'institution_address' => $request->input('institutional_address'),
                'phone' => bcrypt($request->input('phone')),
                'updated_at' => now(),
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);

        // if update fail, then redirect to users.index page with error toast
        if(!$query){
            return redirect()->route('customer.index')->with('error','Record Added Failed. Please Try Again');
        }
        // if update fail, then redirect to users.index page with error toast


        // redirect to users.show page with success toast
        return redirect()->route('customer.show', $customer)->with('success',$request->username . ' have been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
