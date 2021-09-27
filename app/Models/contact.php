<?php

namespace App\Models;

use App\Models\baseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class contact extends baseModel {
   use HasFactory;

   public $timestamps = false;
   protected $table = 'contact';
   protected $primaryKey = 'contactID';
   protected $fillable = ['firstName', 'lastName', 'phone', 'email', 'dob'];

   protected $rules = array(
      'firstName' => 'required|max:45',
      'lastName' => 'required|max:45',
      'phone' => 'max:15',
      'email' => 'max:80',
      'dob' => 'max:10'
   );


   /**
    * Retrieves all rows from table 'contact' that
    * are not marked as deleted.
    * 
    * @return contact
    */
   public function getAllRows() {
      $data = DB::table($this->table)->select('contactID', 'firstName', 'lastName', 'phone', 'email', 'dob')->where('deleted', 'N');
      return $data;
   }


   /**
    * Saves the data into table 'contact'.
    * 
    * @param array $fields
    * @return void
    */
   public function store($fields) {
      if ($this->validate($fields)) {
         if (isset($fields['contactID'])) {
            $m = $this::find($fields['contactID']);
         }
         else {
            $m = new contact;
         }
         $m->firstName = $fields['firstName'];
         $m->lastName = $fields['lastName'];
         $m->phone = $fields['phone'];
         $m->email = $fields['email'];
         $m->dob = $fields['dob'];
         $m->save();
      }
   }


   /**
    * Marks the row, which has the $key, as deleted.
    * 
    * @param int $key
    */
   public function deleteContact($key) {
      DB::table($this->table)->where('contactID', $key)->update(array('deleted' => 'Y'));
   }
}
