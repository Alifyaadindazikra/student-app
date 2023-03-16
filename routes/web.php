<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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


Route::get('/login',[StudentController::class,'login'])->name('login');
Route::post('/auth',[StudentController::class,'auth'])->name('auth');

Route::middleware('IsLogin')->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('home');
    Route::get('/tambah-data',[StudentController::class, 'create']);
    Route::post('/kirim-data',[StudentController::class, 'store'])->name('kirim_data');
//{id} -path dinamis 
//path yang isinya ga tetap atau path yang datanya dikirim dari database 
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::patch('/ubah/{id}', [StudentController::class, 'update'])->name('ubah');
    Route::delete('/hapus/{id}', [StudentController::class, 'destroy'])->name('hapus');
    Route::get('/dashboard',[StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
});

    
    
