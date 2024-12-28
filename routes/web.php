<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;

Route::get('/', [PageController::class, 'index']);       // Home route
Route::get('/product', [PageController::class, 'product']);  // Product page route
Route::get('/contact', [PageController::class, 'contact']);  // Contact page route



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

    
    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductApiController::class, 'index']);
    Route::post('/', [ProductApiController::class, 'store']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
    Route::put('/{id}', [ProductApiController::class, 'update']);
    Route::delete('/{id}', [ProductApiController::class, 'destroy']);
    Route::post('/filter', [ProductApiController::class, 'filter']);
});


Route::get('/search-products', function (Illuminate\Http\Request $request) {
    $query = $request->query('query', '');
    
    $products = Product::where('name', 'like', '%' . $query . '%')
        ->orWhereHas('category', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })
        ->get();

    return response()->json([
        'products' => $products,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
