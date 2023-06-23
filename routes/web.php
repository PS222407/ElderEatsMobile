<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Login;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [Login::class, 'LoadMenu'])->name('menu');
    Route::post('requestConnection', [Login::class, 'RequestConnection'])->name('requestConnection');
});

Route::get('logout', [Login::class, 'LogoutUser'])->name('logout');
Route::post('wait-for-connection/{accountID}', [Login::class, 'waitForResponse'])->name('login.wait-for-response');


Route::middleware('auth')->group(function () {
    Route::get('shopping-list', [ShoppingListController::class, 'index'])->name('shopping-list.index');
    Route::post('shopping-list', [ShoppingListController::class, 'update'])->name('shopping-list.update');

    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('inventory/{productID}/', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('inventory/{productID}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('inventory/{pivotId}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
});

Route::view('/connect', 'Login')->name('connect');
Route::view('/connection-failed', 'LoginFailed')->name('connection-failed');

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/test', 'AddImage')->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/Product-image/{productID}', [InventoryController::class, 'storeImagePage'])->name('Product-image');

Route::post('/upload-image/{productID}', [InventoryController::class, 'storeImage'])->name('upload-image');

Route::get('testweb', function () {
    dd(config('app.api_base_url'), config('app.tablet_domain'));
});

require __DIR__ . '/auth.php';
