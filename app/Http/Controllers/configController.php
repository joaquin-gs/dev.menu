<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\User;

class configController extends Controller
{
   public $aroles;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth');
      $this->aroles = DB::table('role')->select('roleID', 'roleName')->get();
   }


   public function params()
   {
      $capAmount = DB::table('config')->select('capAmount')->get();
      $enLanguage = (Auth::user()->language == 'EN');
      return view('config/params', ['capAmount' => $capAmount[0]->capAmount, 'enLanguage' => $enLanguage]);
   }


   public function saveParams(Request $request)
   {
      $capAmount = $request->input('capAmount');
      DB::table('config')->update(array('capAmount' => $capAmount));
      return view('config/params');
   }


   public function rolePermissions() {
      $query = "SELECT roleID, roleName FROM role WHERE roleName <> 'Admin' AND deleted <> 'Y' ORDER BY roleName";
      $roles = DB::select($query);
      return view('config/permissions', ['roles'=>$roles]);
   }


   public function loadRolePermissions(Request $request) {
      $roleID = $request->roleID;
      $allowedModules = DB::select("SELECT m.moduleID, m.moduleName, " .
                                   "       p.pageID, p.pageName, " .
		                             "       f.formID, f.formName, " .
                                   "       IFNULL(ra.access, 0) AS access " .
                                   "FROM module m " .
                                   "  JOIN page p ON (p.moduleID = m.moduleID) " .
                                   "  JOIN form f ON (f.pageID = p.pageID) " .
                                   "  LEFT JOIN roleaccess ra ON (ra.moduleID = m.moduleID AND ra.pageID = p.pageID AND ra.formID = f.formID AND roleID = ?)", [$roleID]);
      return response()->json($allowedModules);
   }


   public function saveRolePermissions(Request $request) {
      $roleID = $request->roleID;
      $access = $request->access;

      // Delete current permissions to the given role.
      DB::delete("DELETE FROM roleaccess WHERE roleID = ?", [$roleID]);

      // Insert new permissions to the role.
      $result = DB::insert("INSERT INTO roleaccess (roleID, moduleID, pageID, formID, access) VALUES" . $access);
      return $result;
   }


   // Display the view to assign roles to a user.
   public function roles() {
      // Retrieve users and their roles, if any.
      $users = DB::select('SELECT u.id, u.name FROM users u WHERE deleted <> "Y"');
      $enLanguage = (Auth::user()->language == 'EN');
      return view('config/roles', ['users' => $users, 'enLanguage' => $enLanguage]);
   }


   // This method returns the list of roles granted/not granted of a given user ID
   // It is called from the view file roles.blade.php
   public static function getUserRoles($userID) {
      $arrayRoles = DB::select('SELECT r.roleID, r.roleName, NOT isnull(ur.roleID) AS granted ' .
                               'FROM role r LEFT JOIN userrole ur ON (ur.roleID = r.roleID AND ur.userID = ?)', [$userID]);
      return $arrayRoles;
   }


   // Update the users role
   public function saveRoles(Request $request) {
      $arrUserRoles = $request->roles;
      // Delete all the roles assigned to users.
      DB::delete('DELETE FROM userrole');

      // Add newly assigned roles to users.
      for ($i = 0; $i < count($arrUserRoles); $i++) {
         $userId = $arrUserRoles[$i]['userID'];
         $roleId = $arrUserRoles[$i]['roleID'];
         DB::insert('INSERT INTO userrole(userID, roleID) VALUES (?, ?)', [$userId, $roleId]);
      }
   }


   // Retrieves the language preference.
   public function getLanguage()
   {
      $lang = DB::table('users')->where('name', Auth::user()->name)->get(['language']);
      return $lang[0]->language;
   }


   // This method saves the language chosen by the user
   // so that it is kept as his preference.
   public function setLanguage(Request $request)
   {
      $lang = $request->input('lang');
      Auth::user()->language = $lang;
      DB::table('users')->where('name', Auth::user()->name)->update(['language' => $lang]);
      App::setLocale($lang);
   }


   public function hasAccess(Request $request)
   {
      $module = $request->module;
      $page = $request->page;
      $form = $request->form;
      $access = 0;
      $role = User::roleName();

      if ($role != 'Admin') {
         // Retrieve IDs of the requested objects.
         if ($module != "") {
            $module = DB::select("SELECT moduleID FROM module WHERE moduleName = ?", $module);
            if ($page != "") {
               $page = DB::select("SELECT pageID FROM page WHERE moduleID = ? AND pageName = ?", [$module, $page]);
               if ($form != "") {
                  $form = DB::select("SELECT formID FROM form WHERE pageID = ? AND formName = ?", [$page, $form]);
               } else {
                  // The user has access to every form in the given page.
                  $form = 0;
               }
            } else {
               // The user has access to every page in the given module.
               $page = 0;
            }
         } else {
            // The user has access to every module.
            $module = 0;
         }
      }
      // Check if the user has access to the requested objects
      $query = DB::select("SELECT 1 AS result FROM access WHERE userID = ? AND moduleID = ? AND pageID = ? AND formID = ?", [Auth::user()->id, $module, $page, $form]);
      //var_dump($query);
      return ($query[0]->result == 1 || $role == 'Admin');
   }
}
/*

-- Permissions per role
SELECT m.moduleID, m.moduleName,
       p.pageID, p.pageName,
		 f.formID, f.formName,
       IFNULL(ra.access, 0) AS access
FROM module m
  JOIN page p ON (p.moduleID = m.moduleID)
  JOIN form f ON (f.pageID = p.pageID)
  LEFT JOIN roleaccess ra ON (ra.moduleID = m.moduleID AND ra.pageID = p.pageID AND ra.formID = f.formID AND roleID = 2)



-- General list of permissions regardless of role
SELECT m.moduleID, m.moduleName,
       p.pageID, p.pageName,
		 f.formID, f.formName,
       0 AS access
FROM module m
  JOIN page p ON (p.moduleID = m.moduleID)
  JOIN form f ON (f.pageID = p.pageID)



-- List of roles granted/not granted to a given user ID
select r.roleID,
       r.roleName,
       NOT isnull(ur.roleID) AS granted
from role r
  left join userrole ur on (ur.roleID = r.roleID and ur.userID = 2)  

*/