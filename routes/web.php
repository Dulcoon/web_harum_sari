<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\sendEmailController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsCustomer;
use App\Http\Controllers\Api\AuthController;
// use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
// use Illuminate\Routing\Middleware\ThrottleRequests;
// use Illuminate\Routing\Middleware\SubstituteBindings;
// use App\Http\Controllers\Api\UserController;


    

// Route::get('/category/{kategori}', [HomeController::class, 'category'])->name(name: 'home.category');
    
// Route::get('/product', [HomeController::class, 'product'])->name(name: 'homepage.product');


Route::get('/contact-us', [sendEmailController::class, 'showForm'])->name('email.form');

Route::post('/send-email', [sendEmailController::class, 'send_email'])->name('email.send');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('products/create',[ProductController::class,'create'])->name('products.create');
    Route::get('products',[ProductController::class,'index'])->name('products.index');
    Route::post('products',[ProductController::class,'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class,'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class,'update'])->name('products.update');
    Route::delete('products/{product}',[ProductController::class,'destroy'])->name('products.destroy');
    
    
    Route::get('category',[CategoryController::class,'index'])->name('category.index');
    Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('category',[CategoryController::class,'store'])->name('category.store');
    Route::get('category/{category}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('category/{category}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('category/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
    

    // ini utk detail 
    Route::get('products/{product}/detail', [ProductController::class,'detail'])->name('products.detail');


    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});


// middleware untuk customer
Route::middleware([EnsureUserIsCustomer::class])->group(function () {
    Route::get('/product', [HomeController::class, 'product'])->name(name: 'homepage.product');
});


Route::get('/', [HomeController::class, 'showHomePage'])->name('homepage.home');





// buat api
Route::prefix('api')->group(function () {
    Route::middleware(['throttle:api'])->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/customers', [UserController::class, 'index']);
        Route::post('/customers', [UserController::class, 'store']);
        Route::put('/customers/{id}', [UserController::class, 'update']);
        Route::delete('/customers/{id}', [UserController::class, 'destroy']);
    });
});


use App\Http\Controllers\Api\ProductApiController;
Route::get('/api/products', [ProductApiController::class, 'index']);

// Route untuk detail produk
Route::get('/api/products/{id}', [ProductApiController::class, 'show']);







require __DIR__.'/auth.php';
