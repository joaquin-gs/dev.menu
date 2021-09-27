<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class misc extends Model {
   use HasFactory;

   /**
    * This model class contains the methods to manipulate miscelaneous
    * tables that do not belong to the application core.
    */


   /**
    * Retrieves the provinces order by patient frecuency. 
    * @return array $provinces
    */ 
   public function getAllProvinces() {
      $provinces = DB::select("SELECT pr.provinceID, 
                                      pr.provinceNameEn, 
                                      COUNT( p.provinceID ) AS frecuency
                               FROM province pr
                                 LEFT JOIN patient p ON (pr.provinceID = p.provinceID)
                               GROUP BY pr.provinceID, pr.provinceNameEn
                               ORDER BY frecuency DESC");
      return $provinces;
   }


   /**
    * Retrieves the districts of a given province, order by patient frecuency. 
    *
    * @param int $provinceID
    * @return array $districts
    */ 
   public function getDistrictsByProvince($provinceID) {
      $districts = DB::select("SELECT d.districtID, 
                                      d.districtNameEn, 
                                      COUNT( p.districtID ) AS frecuency
                               FROM district d
                                 LEFT JOIN patient p ON (d.districtID = p.districtID)
                               WHERE d.provinceID = ?
                               GROUP BY d.districtID, d.districtNameEn
                               ORDER BY frecuency DESC", [$provinceID]);
      return $districts;
   }


   /**
    * Retrieves the communes of a given district, order by patient frecuency. 
    *
    * @param int $districtID
    * @return array $communes
    */ 
    public function getCommunesByDistrict($districtID) {
      $communes = DB::select("SELECT c.communeID, 
                                     c.communeNameEn, 
                                     COUNT( p.communeID ) AS frecuency
                              FROM commune c
                                LEFT JOIN patient p ON (c.communeID = p.communeID)
                              WHERE c.districtID = ?
                              GROUP BY c.communeID, c.communeNameEn
                              ORDER BY frecuency DESC", [$districtID]);
      return $communes;
   }


   /**
    * Retrieves the villages of a given commune, order by patient frecuency. 
    *
    * @param int $communeID
    * @return array $villages
    */ 
    public function getVillagesByCommune($communeID) {
      $villages = DB::select("SELECT v.villageID, 
                                     v.villageNameEn, 
                                     COUNT( p.villageID ) AS frecuency
                              FROM village v
                                LEFT JOIN patient p ON (p.villageID = v.villageID)
                              WHERE v.communeID = ?
                              GROUP BY v.villageID, v.villageNameEn
                              ORDER BY frecuency DESC", [$communeID]);
      return $villages;
   }
}
