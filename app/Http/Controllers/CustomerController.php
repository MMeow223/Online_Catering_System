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
        if($customer->is_subscribed==0 && $customer->expiry_date < now()){
            DB::table('customers')
                ->where('user_id',Auth::user()->id)
                    ->update([
                        'is_member' => 0,
                    ]);
        }
        elseif($customer->is_subscribed==1 && $customer->expiry_date < now()){
            DB::table('customers')
                ->where('user_id',Auth::user()->id)
                ->update([
                    'expiry_date' => now()->addDays(30),
                ]);
        }
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
            'institutional_name' => 'max:255',
            'institutional_address' => 'max:255',
            'phone' => 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/',
        ]);
        //this is for user database
        $notif = $user->password = bcrypt($request->input('password'));
        $input = $request->only(
            'username',
            'email',
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


        return redirect()->route('customer.index')->with('success',$request->username . ' member updated');

        // redirect to customer.show page with success toast


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function member(){
        $customer = Auth::user()->customer()->first();
        return view('customer.member',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request){
        $customer = Auth::user()->customer()->first();
        $this->validate($request, [
            'is_member' => 'boolean',
            'expiry_date' => 'date',
            'is_subscribed' => 'boolean',
        ]);

        $query= DB::table('customers')
            ->where('user_id',Auth::user()->id)
            ->update([
                'is_member' => $request->input('is_member'),
                'activate_date' => now(),
                'expiry_date' => $request->input('expiry_date'),
                'is_subscribed' => $request->input('is_subscribed'),
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);
        if(!$query){
            return redirect()->route('customer.index')->with('error','Record Added Failed. Please Try Again');
        }

        if($customer->is_member ==1 && $customer->is_subscribed==0){
            \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\RMembershipMail());
            return redirect()->route('customer.index')->with('success',Auth::user()->username . ', member have been reactivated');
        }
        elseif($customer->is_member ==1){
            \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\DMembershipMail());
            return redirect()->route('customer.index')->with('success',Auth::user()->username . ', member have been deactivated');
        }
        else{
            \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\MembershipMail());
            return redirect()->route('customer.index')->with('success',Auth::user()->username . ', member have been activated');
        }

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

    public function updateAddress(Request $request){
        // validate the data
        $this->validate($request, [
            'delivery_address' => 'required|max:255',
        ]);

        Customer::where('user_id',auth()->user()->id)
            ->update(['institution_address'=>$request->input('delivery_address')]);


        return redirect()->back()->with('success','Address updated!');
    }
}
