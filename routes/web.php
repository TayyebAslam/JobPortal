<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\employer_listing\EmployerListingController;
use App\Http\Controllers\admin\CreateListingController;
use App\Http\Controllers\employer\EmployerController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login_view')->name('login');
    Route::post('/', 'login');
    Route::get('register', 'register_view')->name('register');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(AdminController::class, 'admin')->group(function () {
    Route::get('show', 'index')->name('adminprofile');
    Route::patch('details', 'update')->name('admindetails');
    Route::patch('password', 'password')->name('adminpassword');
    Route::patch('picture', 'picture')->name('adminpicture');
    Route::get('employers', 'employers')->name('employers');
    Route::get('showemployers/{id}', 'showemployers')->name('showemployers');
    Route::get('createemployer', 'createemployeradmin')->name('create.employer');
    Route::post('createemployer', 'addemployeradmin');
    Route::get('listings', 'listings')->name('listings');
    Route::get('showlistings/{id}', 'showlistings')->name('showlistings');
    Route::get('editlisting/{id}', 'editlisting')->name('editlisting');
    Route::get('editjoblisting/{id}', 'editjoblisting')->name('editjoblisting');
    Route::patch('updatelisting/{listing}', 'updatelisting')->name('updatelisting');
    Route::get('editemployer/{id}', 'editemployer')->name('editemployer');
    Route::delete('deleteemployer/{id}', 'delete')->name('delete');
    Route::patch('updateemployerdetails/{id}', 'updateemployer')->name('updateemployerdetails');
    Route::patch('updateemployerpassword/{id}', 'updateemployerpassword')->name('updateemployerpassword');
    Route::delete('deleteajoblisting/{listing}', 'destroyajob')->name('deletelisting');
    Route::patch('emppicture/{id}', 'emppicture')->name('emppicture');
    Route::get('createlist', 'createlist')->name('createadminlisting');
    Route::post('storelist', 'storelist')->name('storelisting');
    Route::get('jobseeker', 'jobseeker')->name('jobseeker');
    Route::get('showseeker/{id}', 'showseeker')->name('showseeker');
    Route::get('create_jobseeker', 'create_jobseeker')->name('create_seeker');
    Route::post('create_jobseeker', 'add_jobseeker');
    Route::get('editseeker/{id}', 'editseeker')->name('editseeker');
    Route::patch('updateseekerdetails/{id}', 'updateseeker')->name('updateseekerdetails');
    Route::patch('updateseekerpassword/{id}', 'updateseekerpassword')->name('updateseekerpassword');
    Route::patch('seekerpicture/{id}', 'seekerpicture')->name('seekerpicture');
    Route::delete('deleteseeker/{id}', 'deleteseeker')->name('deleteseeker');
    Route::get('appplication', 'appplication')->name('appplication');
    Route::post('acceptresume/{id}',  'acceptresumeadmin')->name('accept.resumeadmin');
    Route::post('rejectresume/{id}',  'rejectresumeadmin')->name('reject.resumeadmin');
});

Route::controller(EmployerController::class)->group(function () {
    Route::get('employerdashboard', 'index')->name('employerdashboard');
    Route::get('employerprofile', 'profile')->name('employerprofile');
    Route::get('showapplication','applications')->name('showapplication');
    Route::post('accept-resume/{id}',  'acceptResume')->name('accept.resume');
    Route::post('reject-resume/{id}',  'rejectResume')->name('reject.resume');
    // Route::get('', 'applications')->name('applications');

});
Route::controller(EmployerListingController::class)->group(function () {
    Route::get('showlist', 'index')->name('showlisting');
    Route::get('create', 'create')->name('createlisting');
    Route::post('create', 'store');
    Route::get('{listing}/showemployerlistings', 'show')->name('show');
    Route::get('{listing}/edit', 'edit')->name('editlisting');
    Route::post('{listing}/edit', 'update');
    Route::get('{listing}/add_desc', 'add_desc')->name('editadddesc');
    Route::post('{listing}/add_desc', 'add_desc');
    Route::patch('employerpassword', 'password')->name('password');
    Route::patch('employerpicture', 'picture')->name('picture');
    Route::delete('{listing}/edit', 'destroy')->name('destroy');
});

Route::controller(JobSeekerController::class)->group(function () {
    Route::get('seekerdashboard', 'index')->name('job_seekerdashboard');
    Route::get('profile', 'profile')->name('seekerprofile');
    Route::post('profile', 'store');
    Route::get('job', 'job')->name('applyjobs');
    Route::get('{listing}/showjobs', 'showjobs')->name('showjobs');
    Route::get('apply/{listing}', 'apply')->name('apply');
   Route::post('store_application/{listing}', 'store_application')->name('store_application');
   Route::get('show_application', 'showjsapplication')->name('showjsapplication');





});


