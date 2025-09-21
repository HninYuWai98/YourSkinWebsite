<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\UserAuth\UserAuthController;
use App\Http\Controllers\SubCategory\SubCategoryController;



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

// Route::get('/admin', function () {
//     return view('admin.auth.login');
// });


Route::get('/admin/login', [UserAuthController::class, 'login'])->name('admin-login');
Route::post('/admin/login', [UserAuthController::class, 'authLogin'])->name('auth-login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin-dashboard');

Route::resource('user', UserController::class)->names('users')->except('show');
Route::resource('role', RoleController::class)->names('roles')->except('show');
Route::resource('permission', PermissionController::class)->names('permissions')->except('show');
Route::resource('category', CategoryController::class)->names('categories')->except('show');
Route::resource('subcategory', SubCategoryController::class)->names('subCategories')->except('show');
Route::resource('brand', BrandController::class)->names('brands')->except('show');
Route::resource('product', ProductController::class)->names('products')->except('show');
Route::resource('customer', CustomerController::class)->names('customers')->except('show');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});