<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('dang-nhap', [LoginController::class, 'loginForm'])->name('login');
Route::post('dang-nhap', [LoginController::class, 'postLogin']);
Route::get('dang-xuat', function(){
    Auth::logout();
    return redirect(route('plane.index'));
})->name('logout');

Route::prefix('plane')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('plane.index');
    Route::get('/xoa/{id}', [HomeController::class, 'remove'])->name('plane.remove')->middleware('auth');
    Route::get('/tao-moi', [HomeController::class, 'addForm'])->name('plane.add')->middleware('auth');
    Route::post('/tao-moi', [HomeController::class, 'saveAdd']);
    Route::get('/cap-nhat/{id}', [HomeController::class, 'editForm'])->name('plane.edit')->middleware('auth');
    Route::post('/cap-nhat/{id}', [HomeController::class, 'saveEdit']);
});
Route::prefix('brand')->group(function(){
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/xoa/{id}', [BrandController::class, 'remove'])->name('brand.remove')->middleware('auth');
    Route::get('/tao-moi', [BrandController::class, 'addForm'])->name('brand.add')->middleware('auth');
    Route::post('/tao-moi', [BrandController::class, 'saveAdd']);
    Route::get('/cap-nhat/{id}', [BrandController::class, 'editForm'])->name('brand.edit')->middleware('auth');
    Route::post('/cap-nhat/{id}', [BrandController::class, 'saveEdit']);
});