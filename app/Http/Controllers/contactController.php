<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

class contactController extends Controller {

   private $contact;

   public function __construct() {
      $this->middleware('auth');
      $this->contact = new contact();
   }


   public function index() {
      return view('contact/index');
   }


   public function getContacts() {
      $data = $this->contact->getAllRows()->orderBy('firstName')->get();
      return Response::json($data);
   }


   public function store(Request $request) {
      $fields = $request->all();
      // Save contact data.
      try {
         $this->contact->store($fields);
      }
      catch (Exception $e) {
         return Redirect::back()->withErrors($e->getMessage())->withInput();
      }
      // Avoid going to action URLs. 
      return Redirect()->to('/contact');
   }


   public function delete(Request $request) {
      $contactID = $request->input('contactID');
      $this->contact->deleteContact($contactID);
   }
}
