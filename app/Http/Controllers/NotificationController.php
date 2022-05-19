<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Notifications\OffersNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notifications.index')
            -> with('notifications', Notification::all());
    }

    public function admin()
    {
        return view('notifications.admin')
            ->with('notifications', Notification::orderBy('updated_at','DESC')->paginate(10));
    }

    public function create()
    {
        //link to create page
        return view('notifications.create');
    }

    public function createPromotion()
    {
        \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\PromotionMail());
        return redirect('/notifications/create')
            ->with('success', 'Promotion sent successfully');
    }

    public function createVoucher()
    {
        \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\VoucherMail());
        return redirect('/notifications/create')
            ->with('success', 'Voucher sent successfully');
    }

    public function activateMembership()
    {
        \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\MembershipMail());
        return redirect()->back();
    }

    public function orderStatus(){
        \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\OrderMail());
        return redirect()->back();
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'notification_type_option' => 'required|integer',
        ]);

        // check if has image file, then generate unique name, and store to public/images, otherwise assign a default image to it
        if($request->hasFile('image')){
            $image_file_path = 'image_'.time().'_'.rand(0,9).'.jpg';
            $request->file('image')->move(public_path('images'), $image_file_path);
        }
        else{
            $image_file_path = 'default.jpg';
        }

        // create new good
        DB::table('goods')->insert([
            'notification_title' => $request->input('name'),
            'notification_description' => $request->input('description'),
            'notification_image' => $image_file_path,
            'notification_type_id' => $request->input('category_id'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // create the variety of the good
        GoodVarietyController::staticStoreGoodVariety($request);

        // redirect to index page
        return redirect()->route('notifications.admin');

    }

    public function destroy($id)
    {
        // remove the notification
        Notification::destroy($id);

        // redirect admin back to the notification.index page and prompt a success message
        return redirect()->route('notifications.admin')
            ->with('success','Notification deleted');
    }

}
