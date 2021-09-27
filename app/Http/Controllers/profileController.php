<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class profileController extends Controller
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
   public function index() {
      $user = Auth::user();
      $role = $user::roleName();
      $enLanguage = Auth::user()->language == 'EN';
      return view('profile', ['name'=>$user->name, 'email'=>$user->email, 'role'=>$role, 'enLanguage' => $enLanguage]);
   }


   public static function allowTest() {
      $user = Auth::user();
      return $user->name == 'Joaquin';
   }
   

   public function test() {
      return view('test');
   }


   public function store(Request $request) {
      if ($request->hasFile('myPicture')) {
         if ($request->file('myPicture')->isValid()) {
            $validated = $request->validate([
               'myPicture' => 'image|mimes:jpg,jpeg',
            ]);
            //if ($validated) {
               $ext = $request->myPicture->getClientOriginalExtension();
               $request->myPicture->storeAs('', $request->user()->name.'.'.$ext, 'public');
               
               Session::flash('success', "Success!");
               return redirect()->back();
            //}
         }
      }
      abort(500, 'Could not upload image :(');
   }

}
