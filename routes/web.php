<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('/');
Route::get('/home', [FrontendController::class, 'index'])->name('home');
Route::get('/pool/{id?}', [\App\Http\Controllers\FrontendController::class, 'pool'])->name('pool.details');
Route::get('/book/pool/{id?}', [\App\Http\Controllers\FrontendController::class, 'bookPool'])->name('pool.book')->middleware('auth');
Route::post('/book/final', [\App\Http\Controllers\FrontendController::class, 'bookPoolAction'])->name('pool.bookaction')->middleware('auth');
Route::get('/bookings', [\App\Http\Controllers\FrontendController::class, 'myBookings'])->name('bookings')->middleware('auth');
Route::post('/search', [\App\Http\Controllers\FrontendController::class, 'search'])->name('pool.search');
Route::post('/save_token', [\App\Http\Controllers\FrontendController::class, 'saveToken'])->name('save_token');
Route::get('/send_notification', [\App\Http\Controllers\FrontendController::class, 'sendNotification'])->name('send_notification');


//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// owner routes
Route::middleware(['owner'])->name('owner.')->prefix('owner')->group(function(){
    Route::get("/home",[OwnerController::class,'index'])->name('home');
    Route::get("/",[OwnerController::class,'index'])->name('index');
    Route::get('/pools',[PoolController::class,'index'])->name('pools.list');
    Route::get('/add_pool/{id?}',[PoolController::class,'newPool'])->name('add-pool');
    Route::get('/pool/schedule/{id?}',[PoolController::class,'addSchedule'])->name('pools.schedule');
    Route::post('/add_schedule/{id?}',[PoolController::class,'scheduleAction'])->name('scheduleAction');
   // Route::get('/getIBAN/{id?}',[PoolController::class,'newPool'])->name('add-pool');
    Route::post('/add_pool/{id?}',[PoolController::class,'poolaction'])->name('poolaction');
    Route::get('/pool/delete/{id}',[PoolController::class,'delete'])->name('pools.delete');
    Route::get("/bookings",[BookingController::class,'index'])->name('booking.index');
    Route::get("/bookings/list",[BookingController::class,'list'])->name('booking.list');
    Route::get('/booking/{id?}',[BookingController::class,'newBooking'])->name('add-booking');
    Route::post('/booking/{id?}',[BookingController::class,'bookingAction'])->name('bookingaction');
    Route::get('/booking/delete/{id}',[BookingController::class,'delete'])->name('booking.delete');
});

// admin routes
// owner routes
Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get("/home",[AdminController::class,'index'])->name('home');
    Route::get("/",[AdminController::class,'index'])->name('index');
    Route::get("/owners",[AdminController::class,'owners'])->name('owners');
    Route::get("/owners/list",[AdminController::class,'ownerList'])->name('owner.list');
    Route::get("/users",[AdminController::class,'users'])->name('users');
    Route::get("/users/list",[AdminController::class,'userList'])->name('user.list');
    Route::get("/settings",[AdminController::class,'settings'])->name('settings');    
    Route::post('/settings/{id?}',[AdminController::class,'settingsAction'])->name('settingsaction');
});
Route::get('owner/register',[OwnerController::class,'register'])->name('owner.register');
Route::post('owner/register',[OwnerController::class,'registerAction'])->name('owner.registeraction');
Route::get('owner/login',[OwnerController::class,'login'])->name('owner.login');
Route::post('owner/login',[OwnerController::class,'loginAction'])->name('owner.loginaction');
//Route::get('owner/register',[OwnerController::class,'register'])->name('owner.register');
//Route::post('owner/register',[OwnerController::class,'registerAction'])->name('owner.registeraction');
Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'loginAction'])->name('admin.loginaction');
Route::post('/login',[CustomerController::class,'loginAction'])->name('clogin');
// owner ajax routes
Route::middleware(['owner'])->name('ajax.')->prefix('ajax')->group(function(){
    Route::get('/getUsers',[AjaxController::class,'getUsers'])->name('getUsers');
    Route::get('/getUserDetail',[AjaxController::class,'getUserDetail'])->name('getUserDetail');
    Route::get('/pool_bookings',[AjaxController::class,'getPoolBookings'])->name('getPoolBookings');
    Route::get('/get_iban',[AjaxController::class,'getOwnerIBAN'])->name('getIBAN');
    Route::post('/change_booking_status',[AjaxController::class,'changeBookingStatus'])->name('changeBookingStatus');
   
    Route::post('/get_schedule',[AjaxController::class,'getSlots'])->name('get_schedule');
    
});
Route::middleware(['admin'])->name('ajax.')->prefix('ajax')->group(function(){
Route::post('/change_user_status',[AjaxController::class,'changeUserStatus'])->name('changeUserStatus');
});
// frontend ajax routes

    Route::get('/get_iban',[AjaxController::class,'getOwnerIBAN'])->name('getOwnerIBAN');
    Route::post('/get_schedule',[AjaxController::class,'getSlots'])->name('get_schedule');

   

Route::get('/locale/{locale}', function (Request $request, $locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Auth::routes();
