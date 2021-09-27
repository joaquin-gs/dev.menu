<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\registration;
use App\Http\Controllers\opdController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\patientController;
use App\Http\Controllers\configController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\notifications\notifications;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/sendMessage', [HomeController::class, 'sendMessage']);

Route::get('/profile', [profileController::class, 'index']);
Route::post('/profile/store', [profileController::class, 'store']);

Route::get('/registration', [registration::class, 'index']);
Route::get('/opd', [opdController::class, 'index']);

Route::get('/contact', [contactController::class, 'index']);
Route::get('/contact/getContacts', [contactController::class, 'getContacts']);
Route::post('/contact/store', [contactController::class, 'store']);
Route::post('/contact/delete', [contactController::class, 'delete']);

Route::get('/patient', [patientController::class, 'index']);
Route::get('/patient/getPatients', [patientController::class, 'getPatients']);
Route::get('/patient/getTotalPatients', [patientController::class, 'getTotalPatients']);
Route::post('/patient/store', [patientController::class, 'store']);
Route::get('/patient/getDistrictsByProvince', [patientController::class, 'getDistrictsByProvince']);
Route::get('/patient/getCommunesByDistrict', [patientController::class, 'getCommunesByDistrict']);
Route::get('/patient/getVillagesByCommune', [patientController::class, 'getVillagesByCommune']);

Route::get('/profile', [profileController::class, 'index']);
Route::post('/profile/store', [profileController::class, 'store']);
Route::post('/profile/uploadVoiceMsg', [profileController::class, 'uploadVoiceMsg']);
Route::post('/profile/deleteRecording', [profileController::class, 'deleteRecording']);

// System configuration routes
Route::get('/config/params', [configController::class, 'params']);
Route::get('/config/roles', [configController::class, 'roles']);
Route::post('/config/saveParams', [configController::class, 'saveParams']);
Route::post('/config/saveRoles', [configController::class, 'saveRoles']);
Route::post('/config/setLanguage', [configController::class, 'setLanguage']);
Route::get('/config/getLanguage', [configController::class, 'getLanguage']);

Route::get('/config/loadRolePermissions', [configController::class, 'loadRolePermissions']);
Route::get('/config/rolePermissions', [configController::class, 'rolePermissions']);
Route::post('/config/saveRolePermissions', [configController::class, 'saveRolePermissions']);
Route::get('/config/getUserRoles', [configController::class, 'getUserRoles']);

// Websocket routes
Route::post('/sendMessage', [HomeController::class, 'sendMessage']);
Route::get('/wsMonitor', [wsMonitor::class, 'index']);
Route::post('/wsMonitor/sendNotification', [wsMonitor::class, 'sendNotification']);
Route::post('/wsMonitor/getLog', [wsMonitor::class, 'getLog']);

Route::post('/misc/sendContent', [MiscController::class, 'sendContent']);
Route::get('/misc/getData', [MiscController::class, 'getData']);

// Notifications
Route::get('/notifications', [notifications::class, 'index']);
Route::post('/notifications/markNotification', [notifications::class, 'markNotification']);
Route::post('/notifications/markAllAsRead', [notifications::class, 'markAllAsRead']);
Route::get('/notifications/getUnread', [notifications::class, 'getUnread']);
