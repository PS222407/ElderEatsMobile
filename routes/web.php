<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Login;
use App\Http\Controllers\InventoryController;
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
Route::post('waitForConnection/{accountID}', [Login::class, 'waitForResponse'])->name('waitForConnection');

Route::get('inventaris', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('shoppingList', [InventoryController::class, 'GetShoppingList'])->name('shoppingList');
Route::post('UpdateShoppingList', [InventoryController::class, 'UpdateShoppingList'])->name('UpdateShoppingList');
Route::get('inventaris/{productID}/', [InventoryController::class, 'edit'])->name('inventaris.edit');
Route::post('inventaris/{productID}', [InventoryController::class, 'update'])->name('inventaris.update');

Route::view('/Connect', 'Login')->name('connect');
Route::view('/Connectionfailed', 'LoginFailed');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
