<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DocumentController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth', 'user']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('company', CompanyController::class);
    Route::get('company/users/{company_id}', [CompanyController::class, 'user'])->name('company.user');
    Route::post('company/store/user', [CompanyController::class, 'userStore'])->name('company.user.store');
    Route::resource('tag', TagController::class);
    Route::resource('document', DocumentController::class);
});