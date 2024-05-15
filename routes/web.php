<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EditOrdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home.index');
Route::get('/about', AboutController::class)->name('about.index');
Route::get('/contacts', ContactsController::class)->name('contacts.index');
Route::get('/information', InformationController::class)->name('information.index');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/product/{slug}', [ProductController::class, 'index'])->name('catalog.product.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

// Подтверждение почты
Route::get('/email/verify', function () {
    return redirect()->back()->with('status', ['icon' => 'error', 'text' => 'Подтвердите адрес почты для доступа к этой странице!']);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware('auth')->middleware('verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::delete('/profile/address/{id}', [AddressController::class, 'destroy'])->name('profile.address.destroy');
    Route::get('/profile/address/{id?}', [AddressController::class, 'index'])->name('profile.address.index');
    Route::post('/profile/address', [AddressController::class, 'store'])->name('profile.address.store');
    Route::put('/profile/address/{id}', [AddressController::class, 'update'])->name('profile.address.update');

    Route::get('/checkout/{cartIds}/{totalPrice}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/doc/{filename}', DocumentController::class)->name('doc.download');
});

Route::middleware('auth')->middleware('can:edit orders')->group(function () {
    Route::get('/edit/orders', [EditOrdersController::class, 'index'])->name('edit.orders.index');
    Route::post('/edit/orders', [EditOrdersController::class, 'store'])->name('edit.orders.store');
    Route::post('/edit/orders/{id}', [EditOrdersController::class, 'upload'])->name('edit.orders.upload');
});

Route::fallback(function () {
    return redirect('/');
});

require __DIR__ . '/auth.php';
