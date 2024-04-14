<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [ItemController::class, 'index'])->name('home');

// アイテム表示・登録・編集・削除
Route::prefix('items')->group(function () {
    Route::get('/add', [ItemController::class, 'add']);
    Route::post('/add', [ItemController::class, 'add']);
    Route::get('/detail/{id}', [ItemController::class, 'detail'])->name('item.detail');
    Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::post('/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::post('/destroy/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
});
