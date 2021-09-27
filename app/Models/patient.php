<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\baseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class patient extends baseModel {
   use HasFactory;

   public $timestamps = false;
   protected $table = 'patients';
   protected $primaryKey = 'patientID';
   protected $keyType = 'string';
   protected $fillable = ['patientID',
                          'familyNameEn',
                          'firstNameEn',
                          'familyNameKh',
                          'firstNameKh',
                          'gender',
                          'dob',
                          'nationality',
                          'caretakerNameKh',
                          'relationship',
                          'distance',
                          'provinceID',
                          'districtID',
                          'communeID',
                          'villageID',
                          'address',
                          'phone1',
                          'phone2',
                          'bloodGroup',
                          'estimatedDoB',
                          'overAge',
                          'deceased',
                          'isForeigner',
                          'billingCode',
                          'hasPoorId',
                          'poorIdExpiry',
                          'hasHEF',
                          'HEFexpiry',
                          'LMTR',
                          'isEmployee',
                          'thirdPartyPayer',
                          'insuranceName',
                          'employeeCardId',
                          'employeeCardExpiry'];

   protected $rules = array(
      'patientID' => 'required|max:11',
      'familyNameEn' => 'required|max:50',
      'firstNameEn' => 'required|max:50',
      'familyNameKh' => 'required|max:50',
      'firstNameKh' => 'required|max:50',
      'gender' => 'required|in:M,F',
      'dob' => 'required|Date',
      'nationality' => 'required|numeric',
      'caretakerNameKh' => 'required|max:50',
      'relationship' => 'required|max:50',
      'distance' => 'required|max:20',
      'provinceID' => 'required|numeric',
      'districtID' => 'required|numeric',
      'communeID' => 'required|numeric',
      'villageID' => 'required|numeric',
      'address' => 'max:200',
      'phone1' => 'max:15',
      'phone2' => 'max:15',
      'bloodGroup' => 'max:15',
      'estimatedDoB' => 'required|numeric',
      'overAge' => 'required|numeric'
   );

   protected $nationalities;

   public function __construct() {
      // Get the contents of the JSON file
      $this->nationalities = file_get_contents(public_path() . "/js/countries.json");
      // Convert to array 
      $this->nationalities = json_decode($this->nationalities, true);
   }


   /**
    * Retrieves all rows from table 'patients' that
    * are not marked as deleted.
    * 
    * @return patient
    */
   public function getPatients($pagesize, $pagenum, $condition) {
      // Call the stored procedure with output parameter.
      $patients = DB::select('CALL sp_getPatients(?, ?, ?, @numRows)', [$pagesize, $pagenum, $condition, 0]);

      // Get the out parameter returned by the Stored Procedure.
      // Such parameter is an integer value only when $condition is set.
      $numRows = DB::select('SELECT @numRows AS numRows');
      $data = array('patients'=>$patients, 'totRows'=>$numRows);
      return $data;
   }


   public function getNationalities() {
      return $this->nationalities;
   }


   /**
    * Saves the data into table 'patient'.
    * 
    * @param array $fields
    * @return void
    */
   public function store($fields) {
      if ($this->validate($fields)) {
         if (isset($fields['patientID'])) {
            $m = $this::find($fields['patientID']);
         }
         else {
            $m = new patient;
         }
         $m->firstName = $fields['firstName'];
         $m->lastName = $fields['lastName'];
         $m->phone = $fields['phone'];
         $m->email = $fields['email'];
         $m->dob = $fields['dob'];
         $m->save();
      }
   }


}
