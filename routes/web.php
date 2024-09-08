<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



// Route::get('/', function () {
//     return view('welcome');
// });


//--------------   Dashboard    -------------//

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//------------------------------------------//


//--------------   Sections  Route  -------------//

Route::get('/admin-sections', function () {
    return Inertia::render('Sections/Sections');
})->middleware(['auth', 'verified'])->name('admin-sections');

Route::middleware('auth')->group(function () {
    Route::post('/admin-sections/add', [SectionController::class, 'add'])->name('admin-sections.add');
    Route::post('/admin-sections/update', [SectionController::class, 'update'])->name('admin-sections.update');

});

//--------------   End Sections Route    -------------//

//--------------   Products    -------------//
Route::get('/admin-products', function () {
    return Inertia::render('Sections/Products/Products');
})->middleware(['auth', 'verified'])->name('admin-products');

Route::post('/admin-products/add', [ProductController::class, 'add'])->name('admin-products.add');
Route::post('/admin-products/update', [ProductController::class, 'update'])->name('admin-products.update');

//--------------   End Sections Route    -------------//

//--------------   Items    -------------//
Route::get('/admin-items', function () {
    return Inertia::render('Sections/Products/Items/Items');
})->middleware(['auth', 'verified'])->name('admin-items');

//--------------   Offers    -------------//
Route::get('/admin-offers', function () {
    return Inertia::render('Offers/Offers');
})->middleware(['auth', 'verified'])->name('admin-offers');

//--------------   Orders    -------------//
Route::get('/admin-orders', function () {
    return Inertia::render('Orders/Orders');
})->middleware(['auth', 'verified'])->name('admin-orders');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
