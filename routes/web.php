<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\WilayahController;

use App\Http\Controllers\TestWilayahController;
use App\Http\Controllers\Api\AuthController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::get('/penduduk/gender', [PendudukController::class, 'getPendudukByGender']);

Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');

// Route to fetch provinces
Route::get('/api/provinces', function () {
    $response = Http::get('https://wilayah.id/api/provinces.json');
    return response($response->body(), $response->status())
        ->header('Content-Type', 'application/json');
});

// Route to fetch regencies (kabupaten) based on a selected province
Route::get('/api/regencies/{province_id}', function ($province_id) {
    $response = Http::get("https://wilayah.id/api/regencies/{$province_id}.json"); // Use interpolation
    return response($response->body(), $response->status())
        ->header('Content-Type', 'application/json');
});

// Route to fetch districts (kecamatan) based on a selected regency
Route::get('/api/districts/{regency_id}', function ($regency_id) {
    $response = Http::get("https://wilayah.id/api/districts/{$regency_id}.json"); // Use interpolation
    return response($response->body(), $response->status())
        ->header('Content-Type', 'application/json');
});

// Route to fetch villages (kelurahan) based on a selected district
Route::get('/api/villages/{district_id}', function ($district_id) {
    $response = Http::get("https://wilayah.id/api/villages/{$district_id}.json"); // Use interpolation
    return response($response->body(), $response->status())
        ->header('Content-Type', 'application/json');
});









Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PendudukController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('penduduk', PendudukController::class);
});











Route::middleware([EnsureFrontendRequestsAreStateful::class, 'throttle:api'])->group(function () {
    Route::post('/api/login', [AuthController::class, 'login']);
    Route::post('/api/register', [AuthController::class, 'register']); // Endpoint register
    Route::middleware('auth:sanctum')->post('/api/logout', [AuthController::class, 'logout']);
});









require __DIR__.'/auth.php';
