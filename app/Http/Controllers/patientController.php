<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\patient;
use App\Models\misc;

class patientController extends Controller {
   private $patient;
   private $misc;

   public function __construct() {
      $this->middleware('auth');
      $this->misc = new misc();
      $this->patient = new patient;
   }


   public function getAllProvinces() {
      return $this->misc->getAllProvinces();
   }


   public function getDistrictsByProvince(Request $request) {
      return $this->misc->getDistrictsByProvince($request['provinceID']);
   }


   public function getCommunesByDistrict(Request $request) {
      return $this->misc->getCommunesByDistrict($request['districtID']);
   }


   public function getVillagesByCommune(Request $request) {
      return $this->misc->getVillagesByCommune($request['communeID']);
   }


   public function index() {
      $nationalities = $this->patient->getNationalities();
      $provinces = $this->getAllProvinces();
      return view('patient/index', ["nationalities"=>$nationalities, "provinces"=>$provinces]);
   }


   public function getPatients(Request $request) {
      $condition = '';
      $filterscount = $request['filterscount'];
      if ($filterscount > 0) {
         // Build the filter condition from the request object
         for ($i=0; $i < $filterscount; $i++) {
            // get the filter's column.
            $filterdatafield = $request["filterdatafield" . $i];
            // get the filter's value.
            $filtervalue = $request["filtervalue" . $i];
            
            $condition .= " AND p." . $filterdatafield . " LIKE '" . $filtervalue ."%'";
         }
      }

      $data = $this->patient->getPatients($request['pagesize'], $request['pagenum'], $condition);
      return Response::json($data);
   }

   // public function getPatients(Request $request) {
   //    $pagesize = $request['pagesize'];
   //    $pagenum = $request['pagenum'];
   //    $condition = $request['condition'];
   //    $data = $this->patient->getPatients($pagesize, $pagenum, $condition);
   //    return Response::json($data);
   // }


   public function getPatient(Request $request) {
      //
   }


   public function getTotalPatients(Request $request) {
      return Response::json($this->patient->getTotalPatients());
   }
}
