<?php
namespace App;

class wsClient {

   public function __construct() {
      //
   }


   // Creates a temporary connection to the WebSocket Server
   // The parameter $to is the user name the server should reply to.
   public static function sendMsg($msg) {
      $loop = \React\EventLoop\Factory::create();
      $connector = new \React\Socket\Connector($loop, [
         'timeout' => 20,
         'tls' => [ 
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
         ]
      ]);
      $wsClient = new \Ratchet\Client\Connector($loop, $connector);
      $wsClient('wss://dev.menu:8443')->then(function($conn) use ($msg) {
         $conn->send(json_encode($msg));
      }, function ($e) {
         echo "Could not connect: {$e->getMessage()}\n";
      });
      $loop->run();
   }

}
