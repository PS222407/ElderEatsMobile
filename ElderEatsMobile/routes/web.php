<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Login;
use App\Http\Controllers\ProductList;
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

Route::get('ProductList', [ProductList::class, 'LoadProducts'])->name('ProductList');
Route::get('UpdateDate/{productaccountid}/', [ProductList::class, 'updateDate'])->name('Update');
Route::get('shoppingList', [ProductList::class, 'GetShoppingList'])->name('shoppingList');

Route::get('logout', [Login::class, 'LogoutUser'])->name('logout');
Route::post('waitForConnection/{accountID}', [Login::class, 'waitForResponse'])->name('waitForConnection');
Route::post('UpdateDatePost/{productaccountid}', [ProductList::class, 'UpdateDatePost'])->name('UpdateDatePost');
Route::post('UpdateShoppingList', [ProductList::class, 'UpdateShoppingList'])->name('UpdateShoppingList');

Route::view('/Connect', 'Login')->name('connect');
Route::view('/Connectionfailed', 'LoginFailed');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
