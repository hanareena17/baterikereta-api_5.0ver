<?php

use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserPointsController;
use App\Http\Controllers\Api\UserCarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\Api\BatteryBrandController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\BatteryBrandSeriesController;
use App\Http\Controllers\Api\BatterySuggestionController; // Added
use App\Http\Controllers\Api\BookingController; // Added


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

/**
 * Public Routes
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/ping', fn() => response()->json(['message' => 'API OK']));
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/verify-reset-token/{token}', [AuthController::class, 'verifyResetToken']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Public route to get available rewards
Route::get('/rewards', [UserPointsController::class, 'getRewards']);

// Outlets routes
Route::get('/outlets', [OutletController::class, 'index']);
Route::get('/outlets/{id}', [OutletController::class, 'show']);
Route::get('/districts/{districtId}/outlets', [OutletController::class, 'getByDistrict']);

// Battery Brands routes
Route::get('/battery_brands', [BatteryBrandController::class, 'index']);
Route::get('/battery_brands/{id}', [BatteryBrandController::class, 'show']);
Route::get('/battery_brands/{batteryBrandId}/products', [ProductController::class, 'getByBatteryBrand']);

// Products routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Product Categories routes
Route::apiResource('/product-categories', ProductCategoryController::class)->only(['index', 'show']);

// Battery Brand Series routes
Route::apiResource('/battery-brand-series', BatteryBrandSeriesController::class)->only(['index', 'show']);
Route::get('/battery-brands/{batteryBrand}/battery-brand-series', [BatteryBrandSeriesController::class, 'getByBatteryBrand']);


/**
 * Protected Routes - Sanctum
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'activeUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/profile', [UserProfileController::class, 'show']);
    Route::post('/user/profile', [UserProfileController::class, 'update']);
    Route::delete('/user/profile/image', [UserProfileController::class, 'deleteProfileImage']);

    // User Cars
    Route::apiResource('user-cars', UserCarController::class);

    // User Points
    Route::get('/user/points', [UserPointsController::class, 'index']);
    Route::post('/user/points/add', [UserPointsController::class, 'addPoints']);
    Route::post('/user/points/redeem', [UserPointsController::class, 'redeem']);

    // Change Password
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Delete account route
    Route::delete('/user/delete-account', [UserController::class, 'deleteAccount']);

    // Battery Suggestions
    Route::get('/battery-suggestions', [BatterySuggestionController::class, 'suggestByMyCars']);

    // Bookings
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
});

Route::get('/car-brands', [CarBrandController::class, 'index']);
Route::get('/car-brands/{brand}/models', [CarBrandController::class, 'models']);

