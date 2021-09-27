<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EventServiceProvider extends ServiceProvider
{
   /**
    * The event listener mappings for the application.
    *
    * @var array
    */
   protected $listen = [
      Registered::class => [
         SendEmailVerificationNotification::class,
      ],
      'Illuminate\Notifications\Events\NotificationSent' => [
         'App\Listeners\LogNotification',
     ],
   ];

   /**
    * Register any events for your application.
    *
    * @return void
    */
   public function boot()
   {
      /*
      Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
         // Retrieve menu from /config/adminlte.php
         $menu = Config::get('adminlte.menu');

         // Delete default menu.
         $event->menu->remove('notifications');
         $event->menu->remove('header');
         $event->menu->remove('testPage');
         $event->menu->remove('his');
   
         $url = Request()->path();
         switch ($url) {
            case 'registration':
               $menu = Config::get('adminlte.registration');
               break;
            
            case 'opd':
               $menu = Config::get('adminlte.opd');
               break;
         }
         // Build top nav and sidebar menu.
         for ($i=0; $i < count($menu); $i++) {
            $event->menu->add($menu[$i]);
         }
      });
      */
   }

}
