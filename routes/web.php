<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UpgradeAppController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProductsController;

// use App\Http\Middleware\CreateCookie;
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

$maintenanceRoute = App()->maintenance['maintenance']?->route ?: 'preview_mode';
Route::get($maintenanceRoute . '/{token}', [MaintenanceController::class, 'setMode']);
Route::get('maintenance', function () {
    if (App()->maintenance['maintenance']?->active) {
        return view('maintenance.index');
    } else {
        return redirect('/');
    }
});
Route::get('/createCookie', [HomeController::class, 'createCookie'])->name('createCookie');
// Route::middleware([CreateCookie::class])->group(function () {
Route::get('/', [HomeController::class, 'index']);
Route::get('/up-d44s87eswsplc61sx1z7r32fhlj59i6m6e7s4w85s', [UpgradeAppController::class, 'download']);
Route::post('search', [SearchController::class, 'search'])->name('search');
Route::post('/', [HomeController::class, 'quote'])->name('quote');

Route::get('/about-us', function(){
    return view('about-us');
});


Route::get('/products', [ProductsController::class, 'index']);
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('products/{id}', [ProductsController::class, 'addToCart'])->name('addToCart');
// Route::patch('update-cart', [ProductsController::class, 'update'])->name('update_cart');
// Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');

Route::get('/services',[ServiceController::class, 'index']);
Route::get('/service-details/{slug}',[ServiceController::class, 'service'])->name('service');

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'contact'])->name('contact');

// Route::get('/terms-conditions',function(){
//     return view('terms-conditions');
// });
Route::get('/privacy-policy',[HomeController::class, 'law'])->name('privacy-policy');

Route::get('/our-team',function(){
    return view('our-team');
});
Route::get('/gallery/{all?}',[HomeController::class, 'gallery'])->name('gallery');
Route::get('/blog',[BlogController::class, 'index']);
Route::get('/blog-details/{slug}', [BlogController::class, 'post'])->name('post');
Route::get('/faq',[HomeController::class, 'faq']);
Route::post('/faq',[HomeController::class, 'question'])->name('question');

// });
Route::prefix('customer')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('showRegistrationForm');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => config('base.admin_path')], function () {
    Voyager::routes();
});
