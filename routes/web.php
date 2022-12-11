<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function(){
    return view('auth.login');
});

Auth::routes();

// Route::group(['middleware' => 'auth'], function () {});

// admin
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin')->name('admin');
Route::get('/admin/{id}/ubahstatus', [AdminController::class, 'ubahstatus']);
Route::post('admin/updatestatus/{id}', [AdminController::class, 'updatestatus'])->name('updatestatus');
Route::get('/admin/showimage/{id}', [AdminController::class, 'showimage'])->name('showimage');

// pegawai
Route::resource('absen', AbsenController::class)->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
