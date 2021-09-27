<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\createMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
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
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      return view('home');
   }


   /**
    * Retrieves the number of unread notifications of a given user name.
    * Called by WebSocketController.php, when a user has just logged in.
    *
    * @param string $username
    * @return int $numMessages
    */
   public static function getTotalUnreadMessages($username) {
      $user = User::where('name', $username)->get()->first();
      $numMessages = $user->unreadNotifications->count();
      return $numMessages;
   }


   public function sendMessage(Request $request) {
      //$msg = $request['message'];
      //$user = $request['name'];
      //$user = User::where('name', $user)->get()->first();
      //$user = Auth::user();
      //$msg = $user->unreadNotifications->count() + 1;
      //Notification::send($user, new createMessage($msg));
   }
}
