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

  
    $router->group(['middleware' => 'auth'], function() {
        Route::get('/', [ProductList::class, 'LoadProducts'])->name('ProductList');
    });
    $router->group(['middleware' => 'guest'], function() {
        return view('welcome');
    });


Route::post('LoginWait', [Login::class, 'waitForResponse'])->name('LoginWait');
Route::post('UpdateDatePost/{productaccountid}/{accountIndex}', [ProductList::class, 'UpdateDatePost'])->name('UpdateDatePost');

Route::get('ProductList', [ProductList::class, 'LoadProducts'])->name('ProductList');

Route::get('/Connect', function () {
    return view('Login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('UpdateDate/{productaccountid}/{accountIndex}', [ProductList::class, 'updateDate'])->name('Update');


require __DIR__.'/auth.php';
