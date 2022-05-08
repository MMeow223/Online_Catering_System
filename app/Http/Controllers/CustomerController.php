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
        $user = Auth::user();
        // validate the data
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'institutional_name' => 'max:255',
            'institutional_address' => 'max:255',
            'phone' => 'regex:^(\+?6?01)[0-46-9]-*[0-9]{7,8}$^',
        ]);
        //this is for user database
        $notif = $user->password = bcrypt($request->input('password'));
        $input = $request->only(
            'username',
            'email',
            bcrypt('password'),
        );
        $user->update($input);
        //for customers database
        $query = DB::table('customers')
            ->where('user_id',Auth::user()->id)
            ->update([
                'institution_name' => $request->input('institutional_name'),
                'institution_address' => $request->input('institutional_address'),
                'email'=> $request->input('email'),
                'phone' => $request->input('phone'),
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);

        // if update fail, then redirect to customer.index page with error toast
        if(!$notif){
            return redirect()->route('customer.index')->with('error','Record Added Failed. Please Try Again');
        }

        // redirect to customer.show page with success toast
        return redirect()->route('customer.index')->with('success',$request->username . ' ');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function true(){
        $customer = Auth::user()->customer()->first();
        return view('customer.true',['customer'=>$customer]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function false(){
        $customer = Auth::user()->customer()->first();
        return view('customer.false',['customer'=>$customer]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function activateMember(Request $request){
        $this->validate($request, [
            'is_member' => 'boolean',
        ]);

        $query = DB::table('customers')
            ->where('user_id',Auth::user()->id)
            ->update([
                'is_member' => 1,
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);
        if(!$query){
            return redirect()->route('customer.index')->with('error','Record Added Failed. Please Try Again');
        }
        return redirect()->route('customer.index')->with('success',Auth::user()->username . ', member have been activated!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deactivateMember(Request $request){
        $this->validate($request, [
            'is_member' => 'boolean',
        ]);
        $query= DB::table('customers')
            ->where('user_id',Auth::user()->id)
            ->update([
                'is_member' => 0,
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);
        if(!$query){
            return redirect()->route('customer.index')->with('error','Record Added Failed. Please Try Again');
        }
        return redirect()->route('customer.index')->with('too bad',Auth::user()->username . ', member have been deactivated');
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
