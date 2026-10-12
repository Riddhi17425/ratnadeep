<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    LoginController,
    CategoryController,
    BannerController,
    AboutLogoController,
    IndustryController,
    UpcomingEventController,
    BlogController,
    SettingController,
    CertificateController,
    ManufactureStageController,
    ProductController,
    ApplicationPageController,
    JobOpeningController,
    JobApplicationController,
    PageItemController,
    FaqController,
    PageTextController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CertificationController as FrontCertificationController;
use App\Http\Controllers\Front\BlogController as FrontBlogController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\FrontController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [FrontController::class, 'about'])->name('about');
Route::get('/blogs', [FrontBlogController::class, 'index'])->name('blogs');
Route::get('/blog/{slug}', [FrontBlogController::class, 'detail'])->name('blog.detail');
Route::get('/blog-detail/{slug}', fn ($slug) => redirect()->route('blog.detail', $slug, 301));
Route::get('/certifications', [FrontCertificationController::class, 'index'])->name('certifications');
Route::get('/clients', [FrontController::class, 'clients'])->name('clients');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact');
Route::get('/events', [FrontController::class, 'events'])->name('events');
Route::get('/careers', [FrontController::class, 'careers'])->name('careers');
Route::post('/careers/apply', [FrontController::class, 'applyForJob'])->middleware('throttle:6,1')->name('careers.apply');
Route::get('/packaging-shipping', [FrontController::class, 'packagingShipping'])->name('packaging');
Route::get('/inspection-quality-testing', [FrontController::class, 'inspectionQualityTesting'])->name('inspection');
Route::get('/applications', [FrontController::class, 'applications'])->name('applications');
Route::get('/products', [FrontProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [FrontProductController::class, 'show'])->name('product.detail');

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
    Route::resource('about-logos', AboutLogoController::class)->except('show')
        ->parameters(['about-logos' => 'aboutLogo']);
    Route::put('about-logos/{id}/restore', [AboutLogoController::class, 'restore'])->name('about-logos.restore');
    Route::delete('about-logos/{id}/force-delete', [AboutLogoController::class, 'forceDelete'])->name('about-logos.force-delete');
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

    // Products (listing + detail pages)
    Route::resource('products', ProductController::class)->except('show');
    Route::post('products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.status');
    Route::put('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');

    // Applications page hub (shortcuts to its cards, FAQs and texts)
    Route::get('applications-page', [ApplicationPageController::class, 'index'])->name('applications-page.index');

    // Careers: job openings + submitted applications
    Route::resource('job-openings', JobOpeningController::class)->except('show')
        ->parameters(['job-openings' => 'job_opening']);
    Route::post('job-openings/{job_opening}/status', [JobOpeningController::class, 'updateStatus'])->name('job-openings.status');
    Route::put('job-openings/{id}/restore', [JobOpeningController::class, 'restore'])->name('job-openings.restore');
    Route::delete('job-openings/{id}/force-delete', [JobOpeningController::class, 'forceDelete'])->name('job-openings.force-delete');
    Route::resource('job-applications', JobApplicationController::class)->only(['index', 'show', 'destroy'])
        ->parameters(['job-applications' => 'job_application']);
    Route::get('job-applications/{job_application}/resume', [JobApplicationController::class, 'download'])->name('job-applications.download');
    Route::put('job-applications/{id}/restore', [JobApplicationController::class, 'restore'])->name('job-applications.restore');
    Route::delete('job-applications/{id}/force-delete', [JobApplicationController::class, 'forceDelete'])->name('job-applications.force-delete');

    // Inner pages: repeating blocks, FAQs and editable page texts
    Route::resource('page-items', PageItemController::class)->except('show')
        ->parameters(['page-items' => 'page_item']);
    Route::post('page-items/{page_item}/status', [PageItemController::class, 'updateStatus'])->name('page-items.status');
    Route::put('page-items/{id}/restore', [PageItemController::class, 'restore'])->name('page-items.restore');
    Route::delete('page-items/{id}/force-delete', [PageItemController::class, 'forceDelete'])->name('page-items.force-delete');
    Route::resource('faqs', FaqController::class)->except('show');
    Route::post('faqs/{faq}/status', [FaqController::class, 'updateStatus'])->name('faqs.status');
    Route::put('faqs/{id}/restore', [FaqController::class, 'restore'])->name('faqs.restore');
    Route::delete('faqs/{id}/force-delete', [FaqController::class, 'forceDelete'])->name('faqs.force-delete');
    Route::get('page-texts', [PageTextController::class, 'index'])->name('page-texts.index');
    Route::get('page-texts/{page}', [PageTextController::class, 'edit'])->name('page-texts.edit');
    Route::post('page-texts/{page}', [PageTextController::class, 'update'])->name('page-texts.update');    
});
