<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelasBenihController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VarietasController;
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

Route::get('/', function () {
    return view('pages.index', ['title' => 'Home']);
});

Auth::routes();
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable', [UserController::class, 'getUsersDataTable']);
    //varietas managemen
    Route::get('/varietas', [VarietasController::class, 'index'])->name('varietas');
    Route::post('/varietas/store',  [VarietasController::class, 'store'])->name('varietas.store');
    Route::get('/varietas/edit/{id}',  [VarietasController::class, 'edit'])->name('varietas.edit');
    Route::delete('/varietas/delete/{id}',  [VarietasController::class, 'destroy'])->name('varietas.delete');
    Route::get('/varietas-datatable', [VarietasController::class, 'getVarietasDataTable']);
    //kelas Benih managemen
    Route::get('/kelas_benih', [KelasBenihController::class, 'index'])->name('kelas_benih');
    Route::post('/kelas_benih/store',  [KelasBenihController::class, 'store'])->name('kelas_benih.store');
    Route::get('/kelas_benih/edit/{id}',  [KelasBenihController::class, 'edit'])->name('kelas_benih.edit');
    Route::delete('/kelas_benih/delete/{id}',  [KelasBenihController::class, 'destroy'])->name('kelas_benih.delete');
    Route::get('/kelas-benih-datatable', [KelasBenihController::class, 'getKelasBenihDataTable']);
    //desa managemen
    Route::get('/desa', [DesaController::class, 'index'])->name('desa');
    Route::post('/desa/store',  [DesaController::class, 'store'])->name('desa.store');
    Route::get('/desa/edit/{id}',  [DesaController::class, 'edit'])->name('desa.edit');
    Route::delete('/desa/delete/{id}',  [DesaController::class, 'destroy'])->name('desa.delete');
    Route::get('/desa-datatable', [DesaController::class, 'getDesaDataTable']);
    //kecamatan managemen
    Route::get('/kecamatan/getall', [KecamatanController::class, 'getAll'])->name('kecamatan.getall');
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
    Route::post('/kecamatan/store',  [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/kecamatan/edit/{id}',  [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::delete('/kecamatan/delete/{id}',  [KecamatanController::class, 'destroy'])->name('kecamatan.delete');
    Route::get('/kecamatan-datatable', [KecamatanController::class, 'getKecamatanDataTable']);
});
