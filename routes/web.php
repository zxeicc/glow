<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\admin\AdminController;
use App\Http\Controllers\Api\admin\CategoryController;
use App\Http\Controllers\Api\admin\InvitationController;
use App\Http\Controllers\Api\admin\SubCategoryController;
use App\Http\Controllers\Api\admin\ProductController;
use App\Http\Controllers\Api\admin\BrandController;
use App\Http\Controllers\Api\admin\ColorController;
use App\Http\Controllers\Api\admin\SizeController;

use App\Http\Controllers\Web\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Authentication\AuthController;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/login',
    [AuthController::class, 'showLogin']
)->name('admin.login');

Route::post(
    '/admin/login',
    [AuthController::class, 'login']
)->name('admin.login.submit');

Route::post(
    '/admin/logout',
    [AuthController::class, 'logout']
)->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/list',
            [AdminAdminController::class, 'list']
        )->name('admin.list');

        Route::post(
            '/list/delete/{id}',
            [AdminController::class, 'deleted']
        )->name('admin.user.delete');

        Route::get(
            '/list/update/{id}/edit',
            [AdminAdminController::class, 'edit']
        )->name('admin.user.edit');

        Route::post(
            '/update/user/{id}',
            [AdminController::class, 'update']
        )->name('admin.user.update');

        Route::post(
            '/addUser',
            [AdminController::class, 'AddUser']
        )->name('admin.adduser');

        Route::get(
            '/list/search',
            [AdminAdminController::class, 'search']
        )->name('admin.user.search');


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/category',
            [AdminAdminController::class, 'showcategory']
        )->name('admin.category');

        Route::post(
            '/category/delete/{id}',
            [CategoryController::class, 'deleted']
        )->name('admin.category.delete');

        Route::post(
            '/addcategory',
            [CategoryController::class, 'Addcategory']
        )->name('admin.addcategory');

        Route::post(
            '/category/update/{id}',
            [CategoryController::class, 'update']
        )->name('admin.category.update');


        /*
        |--------------------------------------------------------------------------
        | Subcategories
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/subcategory',
            [AdminAdminController::class, 'showsubcategory']
        )->name('admin.subcategory');

        Route::post(
            '/subcategory/delete/{id}',
            [SubCategoryController::class, 'deleted']
        )->name('admin.subcategory.delete');

        Route::post(
            '/addsubcategory',
            [SubCategoryController::class, 'Addsubcategory']
        )->name('admin.addsubcategory');

        Route::post(
            '/subcategory/update/{id}',
            [SubCategoryController::class, 'update']
        )->name('admin.subcategory.update');


        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/brand',
            [BrandController::class, 'index']
        )->name('admin.brand');

        Route::post(
            '/brand/store',
            [BrandController::class, 'store']
        )->name('admin.addbrand');

        Route::post(
            '/brand/update/{brand}',
            [BrandController::class, 'update']
        )->name('admin.brand.update');

        Route::post(
            '/brand/delete/{brand}',
            [BrandController::class, 'destroy']
        )->name('admin.brand.delete');


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/product',
            [ProductController::class, 'index']
        )->name('admin.product');

        Route::post(
            '/product/store',
            [ProductController::class, 'store']
        )->name('admin.addproduct');

        Route::post(
            '/product/update/{product}',
            [ProductController::class, 'update']
        )->name('admin.product.update');

        Route::post(
            '/product/delete/{product}',
            [ProductController::class, 'destroy']
        )->name('admin.product.delete');


        /*
        |--------------------------------------------------------------------------
        | Product Variants
        |--------------------------------------------------------------------------
        |
        | Product
        |    ↓
        | ProductVariant
        |    ├── Size
        |    └── Color
        |
        */

        Route::post(
            '/product/{product}/variant',
            [ProductController::class, 'storeVariant']
        )->name('admin.product.variant.store');

        Route::post(
            '/product/variant/{variant}/delete',
            [ProductController::class, 'destroyVariant']
        )->name('admin.product.variant.delete');


        /*
        |--------------------------------------------------------------------------
        | Colors & Sizes
        |--------------------------------------------------------------------------
        |
        | These manage the master Color and Size records.
        | They are NOT product-specific.
        |
        */

        Route::get(
            '/color-size',
            [AdminAdminController::class, 'showColorSize']
        )->name('admin.color-size');


        /*
        |--------------------------------------------------------------------------
        | Colors
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/color/store',
            [ColorController::class, 'store']
        )->name('admin.color.store');

        Route::post(
            '/color/update/{color}',
            [ColorController::class, 'update']
        )->name('admin.color.update');

        Route::post(
            '/color/delete/{color}',
            [ColorController::class, 'destroy']
        )->name('admin.color.delete');


        /*
        |--------------------------------------------------------------------------
        | Sizes
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/size/store',
            [SizeController::class, 'store']
        )->name('admin.size.store');

        Route::post(
            '/size/update/{size}',
            [SizeController::class, 'update']
        )->name('admin.size.update');

        Route::post(
            '/size/delete/{size}',
            [SizeController::class, 'destroy']
        )->name('admin.size.delete');


        /*
        |--------------------------------------------------------------------------
        | Invitations
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/invitations/{token}',
            [InvitationController::class, 'show']
        )->name('invitations.show');

        Route::post(
            '/invitations/{token}/accept',
            [InvitationController::class, 'accept']
        )->name('invitations.accept');

    });


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
