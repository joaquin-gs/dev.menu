<?php

namespace App\Http\Controllers\notifications;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class notifications extends Controller {

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth');
   }


   /**
    * Displays the notifications view.
    *
    * @return view
    */
   public function index() {
      return view('notifications/index');
   }


   /**
    * Retrieves the unread notifications of the current user.
    * Called via AJAX from js/his/notifications/notifications.js
    *
    * @param Request @request
    * @return json
    */
   public function getUnread(Request $request) {
      $username = $request->username;
      $user = User::where('name', $username)->get()->first();  // Must use find() or first() to get entire object.
      $messages = $user->unreadNotifications;
      return response::json($messages);
   }


   public function markNotification(Request $request) {
      $notificationID = $request->input('id');
      auth()->user()->unreadNotifications->when($notificationID, 
         function ($query) use ($notificationID) {
            return $query->where('id', $notificationID);
         }
      )->markAsRead();
   }


   public function markAllAsRead(Request $request) {
      DB::select('UPDATE notifications SET read_at = ? WHERE notifiable_id = ?', [date("Y/m/d H:i:s"), Auth::user()->id]);
   }
}
