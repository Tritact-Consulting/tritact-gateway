<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\DocVersionController;
use App\Http\Controllers\Admin\FileKeywordController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\GuidesController;
use App\Http\Controllers\HomeController;

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
    Route::resource('guides', GuidesController::class);
    Route::post('documents/download/{id}/{supportive?}/{zip?}/{company_id?}', [DocumentsController::class, 'download'])->name('documents.download');
    Route::post('document/download', [DocumentsController::class, 'downloadAll'])->name('documents.download.all');
    Route::post('guides/download/{id}', [GuidesController::class, 'download'])->name('guides.download');
    Route::get('profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::post('profile/update', [HomeController::class, 'profileUpdate'])->name('profile.update');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('company', CompanyController::class);
    Route::get('company/users/{company_id}', [CompanyController::class, 'user'])->name('company.user');
    Route::post('company/store/user', [CompanyController::class, 'userStore'])->name('company.user.store');
    Route::get('company/{company_id}/edit/user/{id}', [CompanyController::class, 'userEdit'])->name('company.user.edit');
    Route::put('company/update/user/{id}', [CompanyController::class, 'userUpdate'])->name('company.user.update');
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('document', DocumentController::class);
    Route::resource('guide', GuideController::class);
    Route::post('document/read', [DocumentController::class, 'documentRead'])->name('document.read');
    Route::post('document/keyword', [DocumentController::class, 'documentKeyword'])->name('document.keyword');
    Route::post('document/field/delete', [DocumentController::class, 'documentDelete'])->name('document.field.delete');
    Route::resource('version', DocVersionController::class);
    Route::resource('keyword', FileKeywordController::class);
    Route::get('/mark-as-read', [AdminController::class, 'markAsRead'])->name('admin.mark-as-read');
    Route::get('company/dashboard/{company_id}', [CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::post('company/document/download/{id}/{supportive}/{company_id}', [DocumentController::class, 'dashboardDocuments'])->name('company.dashboard.documents.download');
    Route::post('company/document/delete', [DocumentController::class, 'documentsDeleteAll'])->name('documents.delete.all');
});