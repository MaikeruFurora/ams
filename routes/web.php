<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AMSController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest:web', 'preventBackHistory'])->name('auth.')->group(function () {
    Route::get('/', function () { return view('auth/signin');})->name('login');
    Route::post('/post', [AuthController::class, 'loginPost'])->name('login.post');
});


Route::middleware(['auth:web','preventBackHistory','auth.user'])->name('authorize.')->prefix('auth/')->group(function(){
    Route::get('/',  [AMSController::class, 'index'])->name('index');

    //department
    Route::get('asset',  [AssetController::class, 'index'])->name('asset');
    Route::get('asset/create',  [AssetController::class, 'create'])->name('asset.create');
    Route::post('asset/store',  [AssetController::class, 'store'])->name('asset.store');
    Route::get('asset/get-subcategory/{category}',  [AssetController::class, 'getSubCategory'])->name('asset.getsubcategory');
    
    
    Route::get('autoccomplete/{type}',  [AssetController::class, 'autocomplete'])->name('autocomplete');

    //department
    Route::get('department',  [DepartmentController::class, 'index'])->name('department');
    Route::post('department/store',  [DepartmentController::class, 'store'])->name('department.store');
    Route::get('department/list',  [DepartmentController::class, 'list'])->name('department.list');

    //category
    Route::get('category',  [CategoryController::class, 'index'])->name('category');
    Route::post('category/store',  [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/list',  [CategoryController::class, 'list'])->name('category.list');
    
    //sub-category
    Route::get('sub-category',  [SubCategoryController::class, 'index'])->name('sub.category');
    Route::post('sub-category/store',  [SubCategoryController::class, 'store'])->name('sub.category.store');
    Route::get('sub-category/list',  [SubCategoryController::class, 'list'])->name('sub.category.list');
    
    //supplier
    Route::post('supplier/store',  [AssetController::class, 'supplierStore'])->name('supplier.store');
    //supplier
    Route::post('asset-status/store',  [AssetController::class, 'assetStatusStore'])->name('asset.status.store');


    //users
    Route::get('user',  [UserController::class, 'index'])->name('user');
    Route::get('user/create',  [UserController::class, 'create'])->name('user.create');
    Route::get('user/edit/{user}',  [UserController::class, 'edit'])->name('user.edit')->where('id', '[0-9]+');;
    Route::post('user/store',  [UserController::class, 'store'])->name('user.store');
    Route::get('user/list',  [UserController::class, 'list'])->name('user.list');

    //signout
    Route::post('signout', [AuthController::class, 'signout'])->name('signout');
});