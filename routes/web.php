<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DocumentController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentsController;

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
    return redirect(url('/login'));
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth', 'user']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::resource('documents', DocumentsController::class);
    Route::post('documents/download/{id}', [DocumentsController::class, 'download'])->name('documents.download');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('company', CompanyController::class);
    Route::get('company/users/{company_id}', [CompanyController::class, 'user'])->name('company.user');
    Route::post('company/store/user', [CompanyController::class, 'userStore'])->name('company.user.store');
    Route::get('company/{company_id}/edit/user/{id}', [CompanyController::class, 'userEdit'])->name('company.user.edit');
    Route::put('company/update/user/{id}', [CompanyController::class, 'userUpdate'])->name('company.user.update');
    Route::resource('tag', TagController::class);
    Route::resource('document', DocumentController::class);
    Route::post('document/read', [DocumentController::class, 'documentRead'])->name('document.read');
    Route::post('document/keyword', [DocumentController::class, 'documentKeyword'])->name('document.keyword');
    Route::post('document/field/delete', [DocumentController::class, 'documentDelete'])->name('document.field.delete');
});