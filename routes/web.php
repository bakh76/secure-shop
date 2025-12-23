<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public route
Route::get('/', fn() => view('welcome'));

// -----------------------------------------------------------------------------
// NOTE: I removed the generic '/dashboard' route here.
// The AuthenticatedSessionController now redirects directly to
// 'user.dashboard' or 'admin.dashboard' based on the role.
// -----------------------------------------------------------------------------

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2FA setup routes
    Route::get('/2fa', [TwoFactorAuthController::class, 'show2faForm'])->name('2fa.form');
    Route::post('/2fa', [TwoFactorAuthController::class, 'enable2fa'])->name('2fa.enable');

    // 🔥 NEW: Disable Route
    Route::post('/2fa/disable', [TwoFactorAuthController::class, 'disable2fa'])->name('2fa.disable');

    // ------------------------------------
    // RBAC Protected Routes
    // ------------------------------------

    // User routes (Role: User)
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
        // Cart Routes
        Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
        Route::delete('/cart/remove/{cartItem}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('cart.remove');    
        // Checkout Routes
        Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    });

    // Admin routes (Role: Admin)
    Route::middleware('role:admin')->group(function () {
        // Updated path to /admin/dashboard to be explicit, but kept your Controller logic
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Product Management
        Route::get('/admin/products', [AdminController::class, 'indexProducts'])->name('admin.products.index');
        Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
    });

});

// 2FA verification routes (for guests/partial auth)
Route::middleware('guest')->group(function () {
    Route::get('/2fa/verify', [TwoFactorAuthController::class, 'verifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verify2fa'])->name('2fa.verify.post');
});

// Include default auth routes (login, register, etc.)
require __DIR__.'/auth.php';