<?php

use App\Http\Controllers\Web\AllowanceWebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\CompanyWebController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Auth\EmpAuthController;
use App\Http\Controllers\Web\DashboardWebController;
use App\Http\Controllers\Web\EmployeeWebController2;
use App\Http\Controllers\Web\LanguageWebController;
use App\Http\Controllers\Web\RoleWebController;
use App\Http\Controllers\Web\UserWebController;
use App\Http\Middleware\EmpSignInCheck;
use App\Http\Middleware\SignInCheck;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->group(function () {
    Route::get('signin', [EmpAuthController::class, 'signin'])->middleware(EmpSignInCheck::class);
    Route::post('signin', [EmpAuthController::class, 'signInFunction'])->name('app.signin');
    Route::get('signup', [EmpAuthController::class, 'signup'])->middleware(EmpSignInCheck::class);
    Route::post('signout', [EmpAuthController::class, 'destroy'])->name('app.signout');
});

Route::get('signin', [AuthController::class, 'signin'])->middleware(SignInCheck::class);
Route::post('signin', [AuthController::class, 'signInFunction'])->name('signin');
Route::get('signup', [AuthController::class, 'signup'])->middleware(SignInCheck::class);
Route::post('signout', [AuthController::class, 'destroy'])->name('signout');

Route::middleware('emp.auth')->group(function () {
    Route::prefix('app/organization')->group(function () {
        foreach (config('organization') as  $link) {
            Route::get($link['url'], [$link['controller'], 'index']);
        }
    });
    Route::prefix('app')->group(function () {
        foreach (config('links') as $link) {
            Route::get($link['url'], [$link['controller'], 'index']);
        }
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardWebController::class, 'index'])->name('home');
    Route::get('home', [DashboardWebController::class, 'index'])->name('home');
    Route::resource('dashboard', DashboardWebController::class);
    Route::resource('roles', RoleWebController::class);
    Route::resource('employees', EmployeeWebController2::class);
    Route::resource('allowances', AllowanceWebController::class);
    Route::resource('companies', CompanyWebController::class);
    Route::resource('languages', LanguageWebController::class);
});

Route::resource('users', UserWebController::class);
