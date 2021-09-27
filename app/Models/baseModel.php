<?php
/*
 * This class was created to serve as a base to any other
 * model class that needs to have an implementation to validate
 * the data that is pretended to be saved to the database.
 * It also manages the errors and the rules defined to validate data.
 */
 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class baseModel extends Model {
   /**
    * @var array $rules
    */
   protected $rules = array();

   /**
    * @var array $errors
    */
   protected $errors;


   /**
    * @param array $data
    * @return boolean
    */
   public function validate($data) {
      // make a new validator object
      $v = Validator::make($data, $this->rules);

      // check for failure
      if ($v->fails()) {
         // set errors and return false
         $this->errors = $v->errors();
         return false;
      }

      // validation pass
      return true;
   }


   /**
    * @return array
    */
   public function errors() {
      return $this->errors;
   }
}
?>
