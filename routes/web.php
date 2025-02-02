<?php

use App\Http\Controllers\backend\AdminDeshboard;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\LogActivityController;
use App\Http\Controllers\backend\LogoController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\ClientShoppingController;
use Illuminate\Support\Facades\Route;

/*=============================================== 
                    # Route Frontend
==============================================*/

Route::get('/',[ClientShoppingController::class,'index'])->name('home');
Route::get('/shop',[ClientShoppingController::class,'shops'])->name('shop');
Route::get('/news',[ClientShoppingController::class,'news'])->name('news');
Route::get('/product/{id}',[ClientShoppingController::class,'product'])->name('product.detail');
Route::get('/news_detail/{id}',[ClientShoppingController::class,'news_detail'])->name('news.detail');
Route::get('/article',[ClientShoppingController::class,'article'])->name('product.article');
Route::get('/search',[ClientShoppingController::class,'search'])->name('product.search');

/*=============================================== search
                    # Route Backend
==============================================*/
    // Route login and Register Page
Route::get('/backend/admin/login',[AuthController::class,'login'])->name('login');
Route::get('/backend/admin/register',[AuthController::class,'register'])->name('register');
Route::post('/backend/admin/submit/login',[AuthController::class,'submitLogin'])->name('login.submit');
Route::post('/backend/admin/submit/register',[AuthController::class,'submitRegister'])->name('register.submit');
    // Route Logout
Route::get('/backend/admin/logout',[AuthController::class,'logout'])->name('logout');
Route::post('backend/admin/logut/submit',[AuthController::class,'submitLogout'])->name('logout.submit');

    // Middle ware group
Route::middleware(['auth'])->group(function () {
    // Route admin dashboard
    Route::get('/backend/admin/dashboard',[AdminDeshboard::class,'deshboard'])->name('deshboard');

    // Route view category
    Route::get('/backend/admin/category',[CategoryController::class,'index'])->name('category.view');
    Route::get('/backend_admin_category/add',[CategoryController::class,'addCategory'])->name('category.add');
    Route::post('/backend/admin/submit_category',[CategoryController::class,'sunmitCategory'])->name('category.submit');
    // Rout Update Category
    Route::get('/backend/admin/update_category/{id}',[CategoryController::class,'updateCategory'])->name('category.update');
    Route::post('/backend_admin_category/submit_update_category',[CategoryController::class,'submitUpdateCategory'])->name('category.submitUpdate');
    // Rout Remove Category
    Route::post('/backend/admin_category_submit_remove_category',[CategoryController::class,'SubmiteRemoveCategory'])->name('category.submitRemove');
    // Route logo
    Route::get('/backend_admin_view/logo',[LogoController::class,'viewLogo'])->name('logo.view');
    Route::get('/backend_admin_logo/add',[LogoController::class,'logoAdd'])->name('logo.add');
    Route::post('/backend_admin_logo_submit',[LogoController::class,'submitLogo'])->name('logo.submit');
    // Route Update Logo
    Route::get('backend/admin/update/logo/{id}',[LogoController::class,'updateLogo'])->name('logo.update');
    Route::post('/backend_logo_submit/update',[LogoController::class,'submitUpdateLogo'])->name('logo.updatesubmit');
    // Route Remove Logo
    Route::post('/backend_admin_logo_submit/remove',[LogoController::class,'submitRemoveLogo'])->name('logo.submitRemove');
    // Route Product
    Route::get('/backend_admin_add/product',[ProductController::class,'addProduct'])->name('product.add');
    Route::get('/backend_admin_product/view',[ProductController::class,'viewProduct'])->name('product.view');
    Route::post('/backend_admin_product/submit',[ProductController::class,'submitProduct'])->name('product.submit');
    // Route Update Product
    Route::get('/backend_admin_product_update_product/{id}',[ProductController::class,'updateProduct'])->name('product.update');
    Route::post('/backend_admin/submit_update_product',[ProductController::class,'submitUpdateProduct'])->name('product.submitUpdate');
    // Route Remove Product
    Route::post('/backend/admin/submit/remove/product',[ProductController::class,'submitRemove'])->name('product.submitRemove');
    // Route News Blog
    Route::get('/backend_admin_news/add',[NewsController::class,'news'])->name('news.add');
    Route::get('/backend_admin_news/view',[NewsController::class,'viewNews'])->name('news.view');
    Route::post('/backend_admin_news/submit',[NewsController::class,'submitNews'])->name('news.submit');
    // Route update News Blog
    Route::get('/backend_admin_update_news/{id}',[NewsController::class,'updateNews'])->name('news.update');
    Route::post('/backend_admin_news_submit/update',[NewsController::class,'submitUpdateNews'])->name('news.submitUpdate');
    // Route Remove News Blog
    Route::post('/backend_admin_submit_remove/news',[NewsController::class,'submitRemoveNews'])->name('news.submitRemove');
    // Route Log Activity
    Route::get('/backend_admin_log_activity',[LogActivityController::class,'LogActivity'])->name('logActivity');
});
