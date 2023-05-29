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
use App\Models\ClientVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/up-d44s87eswsplc61sx1z7r32fhlj59i6m6e7s4w85s', [UpgradeAppController::class, 'download']);
Route::post('search', [SearchController::class, 'search'])->name('search');
Route::post('/', [HomeController::class, 'quote'])->name('quote');

Route::get('/about-us', function(){
    return view('about-us');
});


Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/product-details/{id}', [ProductsController::class, 'show'])->name('product');
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::post('products/{id}', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::post('cart', [ProductsController::class, 'purchase'])->name('purchase')->middleware(['client.auth','is_verify_email']);
Route::get('cart/{productId}', [ProductsController::class, 'removeProduct'])->name('remove_from_cart');

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
    Route::middleware('client.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('showRegistrationForm');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('/password/forgot', [LoginController::class, 'showForgotForm'])->name('showForgotForm');
    Route::post('/password/forgot', [LoginController::class, 'sendResetLink'])->name('sendResetLink');
    Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('showResetForm');
    Route::post('/password/reset', [LoginController::class, 'resePassword'])->name('resePassword');
});

/* New Added Route */
Route::get('/email/verify/{token}', [RegisterController::class, 'verifyClient'])->name('client.verify'); 

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('client.auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
        $client=Auth::guard('client')->user();
        $clientVerify = ClientVerify::where('client_id', $client->id)->first();
        $token = $clientVerify->token;
        try {
            Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($client) {
                $message->from('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->to($client->email);
                $message->replyTo('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->subject('Email Verification Mail');
                $message->priority(1);
                //$message->attach('pathToFile');
            });
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                return back()->with('error', 'Something went wrong. Please try again later.');
            }
        }
 
    return back()->with('success', 'Verification link sent!');
})->middleware(['client.auth', 'throttle:6,1'])->name('verification.send');

Route::group(['prefix' => config('base.admin_path')], function () {
    Voyager::routes();
});
