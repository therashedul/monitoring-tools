<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Auth::routes(['register' => false]);  // Can`t registrition with out login

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('home.custom'); 
Route::get('/home', [CustomAuthController::class, 'dashboard'])->name('home'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');
Route::get('/services.create',  [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
Route::post('/services.store', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
Route::get('services.edit.{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
Route::post('services.update', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
Route::get('/services.destroy/{id}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');


Route::get('/revenew', [App\Http\Controllers\RevenewController::class, 'index'])->name('revenew');
Route::get('/revenew.create',  [App\Http\Controllers\RevenewController::class, 'create'])->name('revenew.create');
Route::post('/revenew.store', [App\Http\Controllers\RevenewController::class, 'store'])->name('revenew.store');
Route::get('revenew.edit.{id}', [App\Http\Controllers\RevenewController::class, 'edit'])->name('revenew.edit');
Route::post('revenew.update', [App\Http\Controllers\RevenewController::class, 'update'])->name('revenew.update');
Route::get('/revenew.destroy/{id}', [App\Http\Controllers\RevenewController::class, 'destroy'])->name('revenew.destroy');

Route::post('revenew.search', [App\Http\Controllers\RevenewController::class, 'revenewsearch'])->name('revenew.search');

Route::get('/report', [App\Http\Controllers\RevenewController::class, 'report'])->name('report');

Route::get('/clear', function () {
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('event:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('optimize:clear');
    return "clear";
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');