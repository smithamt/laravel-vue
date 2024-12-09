<?php

use App\Http\Controllers\Api\AllowanceApiController;
use App\Http\Controllers\Api\AppraisalApiController;
use App\Http\Controllers\Api\AssetApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\HostelApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('api.emp.auth')->group(function () {
    Route::apiResource('/employees', EmployeeApiController::class);
    Route::apiResource('/allowances', AllowanceApiController::class);
    Route::apiResource('/assets', AssetApiController::class);
    Route::apiResource('/appraisals', AppraisalApiController::class);
    Route::apiResource('/hostels', HostelApiController::class);
});
