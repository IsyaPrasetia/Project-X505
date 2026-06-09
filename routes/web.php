<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebinarController;
use App\Models\ContactSetting;
use App\Models\Speaker;
use App\Models\Testimonial;
use App\Models\Webinar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $webinars = Webinar::active()->where('date', '>=', now())->where('register_closed', false)->orderBy('date', 'asc')->take(4)->get();
    $speakers = Speaker::where('is_active', true)->orderBy('date', 'desc')->orderBy('created_at', 'desc')->take(6)->get();
    $testimonials = Testimonial::where('is_active', true)->orderBy('date', 'desc')->orderBy('created_at', 'desc')->take(4)->get();
    $contacts = ContactSetting::pluck('value', 'key')->toArray();

    return view('home', compact('webinars', 'speakers', 'testimonials', 'contacts'));
});

Route::get('/webinars', function () {
    $webinars = Webinar::active()->where('date', '>=', now())->where('register_closed', false)->orderBy('date', 'asc')->get();
    $contacts = ContactSetting::pluck('value', 'key')->toArray();

    return view('webinars', compact('webinars', 'contacts'));
});

Route::get('/webinar/{id}', [WebinarController::class, 'show']);

Route::get('/contact', function () {
    $contacts = ContactSetting::pluck('value', 'key')->toArray();

    return view('contact', compact('contacts'));
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/webinar/store', [AdminController::class, 'storeWebinar'])->name('admin.webinar.store');
    Route::post('/admin/webinar/{webinar}/update', [AdminController::class, 'updateWebinar'])->name('admin.webinar.update');
    Route::post('/admin/webinar/{webinar}/delete', [AdminController::class, 'destroyWebinar'])->name('admin.webinar.delete');
    Route::post('/admin/speaker/store', [AdminController::class, 'storeSpeaker'])->name('admin.speaker.store');
    Route::post('/admin/speaker/{speaker}/update', [AdminController::class, 'updateSpeaker'])->name('admin.speaker.update');
    Route::post('/admin/speaker/{speaker}/delete', [AdminController::class, 'destroySpeaker'])->name('admin.speaker.delete');
    Route::post('/admin/testimonial/store', [AdminController::class, 'storeTestimonial'])->name('admin.testimonial.store');
    Route::post('/admin/testimonial/{testimonial}/update', [AdminController::class, 'updateTestimonial'])->name('admin.testimonial.update');
    Route::post('/admin/testimonial/{testimonial}/delete', [AdminController::class, 'destroyTestimonial'])->name('admin.testimonial.delete');
    Route::post('/admin/contact/update', [AdminController::class, 'updateContact'])->name('admin.contact.update');
});
