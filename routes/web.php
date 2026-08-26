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
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CertificationController as FrontCertificationController;
use App\Http\Controllers\Front\BlogController as FrontBlogController;
use App\Http\Controllers\FrontController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [FrontController::class, 'about'])->name('about');
Route::get('/blogs', [FrontBlogController::class, 'index'])->name('blogs');
Route::get('/blog-detail/{slug}', [FrontBlogController::class, 'detail'])->name('blog.detail');
Route::get('/certifications', [FrontCertificationController::class, 'index'])->name('certifications');
Route::get('/clients', [FrontController::class, 'clients'])->name('clients');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact');
Route::get('/events', [FrontController::class, 'events'])->name('events');

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
    Route::put('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('banners', BannerController::class);
    Route::put('banners/{id}/restore', [BannerController::class, 'restore'])->name('banners.restore');
    Route::delete('banners/{id}/force-delete', [BannerController::class, 'forceDelete'])->name('banners.force-delete');
    Route::resource('industries', IndustryController::class);
    Route::post('industries/{industry}/status', [IndustryController::class, 'updateStatus'])->name('industries.status');
    Route::put('industries/{id}/restore', [IndustryController::class, 'restore'])->name('industries.restore');
    Route::delete('industries/{id}/force-delete', [IndustryController::class, 'forceDelete'])->name('industries.force-delete');
    Route::resource('upcoming-events', UpcomingEventController::class)
    ->parameters(['upcoming-events' => 'upcoming_event']);
    Route::post('upcoming-events/{upcoming_event}/status', [UpcomingEventController::class, 'updateStatus'])->name('upcoming-events.status');
    Route::put('upcoming-events/{id}/restore', [UpcomingEventController::class, 'restore'])->name('upcoming-events.restore');
    Route::delete('upcoming-events/{id}/force-delete', [UpcomingEventController::class, 'forceDelete'])->name('upcoming-events.force-delete');
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/status', [BlogController::class, 'updateStatus'])->name('blogs.status');
    Route::put('blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');
    Route::delete('blogs/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blogs.force-delete');
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('certificates', CertificateController::class);
    Route::post('certificates/{certificate}/status', [CertificateController::class, 'updateStatus'])->name('certificates.status');
    Route::put('certificates/{id}/restore', [CertificateController::class, 'restore'])->name('certificates.restore');
    Route::delete('certificates/{id}/force-delete', [CertificateController::class, 'forceDelete'])->name('certificates.force-delete');
    Route::resource('manufacture-stages', ManufactureStageController::class)
    ->parameters(['manufacture-stages' => 'manufacture_stage']);
    Route::post('manufacture-stages/{manufacture_stage}/status', [ManufactureStageController::class, 'updateStatus'])->name('manufacture-stages.status');
    Route::put('manufacture-stages/{id}/restore', [ManufactureStageController::class, 'restore'])->name('manufacture-stages.restore');
    Route::delete('manufacture-stages/{id}/force-delete', [ManufactureStageController::class, 'forceDelete'])->name('manufacture-stages.force-delete');    
});

