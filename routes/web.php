<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssistanceController;

Route::get('/register-case', [ApplicantController::class, 'createPublic'])->name('public.case.create');
Route::post('/register-case', [ApplicantController::class, 'storePublic'])->name('public.case.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('associations', AssociationController::class);
    Route::resource('users', UserController::class);
    Route::get('activities', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activities.index');
    Route::resource('applicants', ApplicantController::class);
    Route::post('applicants/search', [ApplicantController::class, 'search'])->name('applicants.search');
    Route::resource('assistances', AssistanceController::class)->except(['index', 'create']);
    Route::get('assistances/create/{applicant}', [AssistanceController::class, 'create'])->name('assistances.create');
});
