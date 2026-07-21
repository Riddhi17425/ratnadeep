<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\UpcomingEventController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ManufactureStageController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginController::class, 'register_page'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login_page'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});

Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/status', [CategoryController::class, 'updateStatus'])->name('categories.status');
    Route::resource('banners', BannerController::class);
    Route::post('banners/{banner}/status', [BannerController::class, 'updateStatus'])->name('banners.status');
    Route::resource('industries', IndustryController::class);
    Route::post('industries/{industry}/status', [IndustryController::class, 'updateStatus'])->name('industries.status');
    Route::resource('upcoming-events', UpcomingEventController::class)
        ->parameters(['upcoming-events' => 'upcoming_event']);
    Route::post('upcoming-events/{upcoming_event}/status', [UpcomingEventController::class, 'updateStatus'])->name('upcoming-events.status');
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/status', [BlogController::class, 'updateStatus'])->name('blogs.status'); 
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('certificates', CertificateController::class);
    Route::post('certificates/{certificate}/status', [CertificateController::class, 'updateStatus'])->name('certificates.status');
    Route::resource('manufacture-stages', ManufactureStageController::class)
        ->parameters(['manufacture-stages' => 'manufacture_stage']);
    Route::post('manufacture-stages/{manufacture_stage}/status', [ManufactureStageController::class, 'updateStatus'])->name('manufacture-stages.status');




    
    });

