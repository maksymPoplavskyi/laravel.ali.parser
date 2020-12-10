<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/shop')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('shop');

    Route::get('/create', [ProductController::class, 'createView'])->name('shop.create.view');
    Route::post('/create', [ProductController::class, 'createAction'])->name('shop.create');

    Route::get('/update/{product_id}', [ProductController::class, 'updateView'])->name('shop.update.view');
    Route::patch('/update/{product_id}', [ProductController::class, 'updateAction'])->name('shop.update');

    Route::get('/{category_slug}', [CategoryController::class, 'index'])->name('shop.category');
    Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('shop.view');

    Route::get('/delete/{product_id}', [ProductController::class, 'deleteAction'])->name('shop.delete');
});

Route::get('/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');
