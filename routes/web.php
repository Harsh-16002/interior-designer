<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderContentController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\WhyUsController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;



// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

//forget password

Route::get('auth/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('auth/sendotp', [AuthController::class, 'sendOtp'])->name('auth.sendotp');
Route::get('auth/verify-otp', [AuthController::class, 'otpVerify'])->name('otp.verify.page');
Route::post('auth/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::get('auth/reset-password', [AuthController::class, 'resetpassword'])->name('reset.password');
Route::post('updatepassword', [AuthController::class, 'updatepassword'])->name('update.password');


#user
Route::get('/', [UserController::class, 'index']);
Route::get('/projects', [UserController::class, 'project'])->name('projects.show');
Route::get('/about', [UserController::class, 'about'])->name('about.show');
Route::get('/contact', [UserController::class, 'contact'])->name('contact.show');


#Admin 

Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/subscribers/check', [DashboardController::class, 'getNewSubscribers'])
        ->name('admin.subscribers.check');
    Route::get('/subscribers/all', [DashboardController::class, 'getAllSubscribers'])
        ->name('admin.subscribers.all');
    Route::delete('/subscribers/{id}', [DashboardController::class, 'deleteSubscriber'])
        ->name('admin.subscribers.destroy');
    Route::post('/subscribers/mark-seen', [DashboardController::class, 'markSeen'])
        ->name('admin.subscribers.markSeen');
    Route::resource('contact-content', ContactController::class);
    Route::resource('subscriber-content', SubscriberController::class)->only(['store']);;
    Route::post('subscribe', [SubscriberController::class, 'store'])->name('subscribe');
    Route::resource('header-content', HeaderContentController::class);
    Route::resource('hero-content', HeroController::class);
    Route::resource('about-content', AboutController::class);
    Route::resource('whyus-content', WhyUsController::class);
    Route::resource('projects-content', ProjectController::class);
    Route::resource('services-content', ServicesController::class);
    Route::resource('counters-content', CountersController::class);
    Route::resource('team-content', TeamController::class);
    Route::resource('testimonials-content', TestimonialsController::class);
});
