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
    Route::get('inventory', [ProductList::class, 'LoadProducts'])->name('ProductList');
});

Route::get('ProductList/{ConnectionNumber}', [ProductList::class, 'LoadProducts'])->name('ProductList');
Route::get('UpdateDate/{productaccountid}/{accountIndex}', [ProductList::class, 'updateDate'])->name('Update');
Route::get('shoppingList/{accountIndex}', [ProductList::class, 'GetShoppingList'])->name('shoppingList');

Route::get('logout', [Login::class, 'LogoutUser'])->name('logout');
Route::post('requestConnection', [Login::class, 'RequestConnection'])->name('requestConnection');
Route::post('waitForConnection/{accountID}', [Login::class, 'waitForResponse'])->name('waitForConnection');
Route::post('UpdateDatePost/{productaccountid}/{accountIndex}', [ProductList::class, 'UpdateDatePost'])->name('UpdateDatePost');
Route::get('/Connect', 'Login');
Route::get('/Connectionfailed', 'LoginFailed');
Route::get('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
