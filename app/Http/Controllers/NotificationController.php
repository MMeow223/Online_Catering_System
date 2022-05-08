<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
            ->with('notifications', Notification::orderBy('updated_at','DESC')->paginate(10));
    }

    public function create()
    {
        //link to create page
        return view('notifications.create');
    }

    public function destroy($id)
    {
        // remove the notification
        Notification::destroy($id);

        // redirect admin back to the notification.index page and prompt a success message
        return redirect()->route('notifications.index')
            ->with('success','Notification deleted');
    }

    public function sendOfferNotification() {
        $userSchema = User::first();

        $offerData = [
            'name' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($userSchema, new OffersNotification($offerData));

        dd('Task completed!');
    }
}
