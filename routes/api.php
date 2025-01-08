<?php

use App\Http\Controllers\Api\AllowanceApiController;
use App\Http\Controllers\Api\AppraisalApiController;
use App\Http\Controllers\Api\AssetApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\HostelApiController;
use App\Http\Controllers\Api\PositionApiController;
use App\Http\Controllers\Api\RoomApiController;
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

    //hostels
    Route::apiResource('/hostels', HostelApiController::class);
    Route::get('/hostels/{hostelId}/employees', [HostelApiController::class, 'getEmployees']);

    //rooms
    Route::apiResource('/rooms', RoomApiController::class);
    Route::get('/rooms/{roomId}/employees', [RoomApiController::class, 'getEmployees']);
    Route::post('/rooms/import', [RoomApiController::class, 'importRooms']);
    Route::post('/room-employees/import', [RoomApiController::class, 'importEmployees']);
    Route::post('/rooms/{roomId}/add-employees', [RoomApiController::class, 'addEmployees']);
    Route::post('/rooms/{roomId}/add-employee', [RoomApiController::class, 'addEmployee']);
    Route::delete('/employee-rooms/{employeeRoomId}', [RoomApiController::class, 'removeEmployee']);

    //positions
});

Route::apiResource('positions', PositionApiController::class);