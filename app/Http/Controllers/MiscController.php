<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MiscController extends Controller {

   private $data;

   public function __construct() {
      $this->data = '';
   }


   public function sendContent(Request $request) {
      $content = $request['content'];
      if (!is_null($content)) {
         $this->data = "data:". $content ."\n\n";
      }
      $this->getData();
   }


   public function getData() {
      return response($this->data)->withHeaders(['Content-Type'=>'text/event-stream', 'Cache-Control'=>'no-cache']);
   }

}
