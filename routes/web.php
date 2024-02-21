<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use Spatie\Sitemap\SitemapGenerator;

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

Auth::routes();
Auth::routes(['verify' => true]); //email verify

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('products', ProductController::class);
// });

//multiple image upload
Route::group(['middleware'=> ['guest']], function() {
    Route::get('/image-upload', [FileController::class, 'createForm']);
    Route::post('/image-upload', [FileController::class, 'fileUpload'])->name('imageUpload');
    Route::get('/image-upload-dua', [FileController::class, 'uploadsDua'])->name('create.images');
    Route::post('image-upload-dua', [FileController::class, 'storeImages'])->name('store.images');
    // Route::resource('uploads', ImageController::class);
});

Route::get('/generate-sitemap', function() {
    // SitemapGenerator::create('http://app.test')->getSitemap()->writeToFile(public_path('sitemap.xml'));
    $exitCode = Artisan::call('sitemap:generate');
    return 'Sitemap Created Successfully';
});