<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AnnouncementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/announcement', [AnnouncementController::class, 'Announcements']);
    Route::post('/announcement/store', [AnnouncementController::class, 'Store']);
    Route::put('/announcement/update/{id}', [AnnouncementController::class, 'Update']);
    Route::delete('/announcement/delete/{id}', [AnnouncementController::class, 'Delete']);

});