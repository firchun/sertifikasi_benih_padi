<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelasBenihController;
use App\Http\Controllers\PenangkarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VarietasController;
use App\Models\PenangkarAnggota;
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
Route::get('/maps', function () {
    return view('pages.maps', ['title' => 'Lokasi Penangkar']);
})->name('maps');
Route::get('/stoks', function () {
    return view('pages.stok', ['title' => 'Stok Benih']);
})->name('stoks');
Route::get('/varietas-unggulan', function () {
    return view('pages.varietas', ['title' => 'Varietas Unggulan']);
});
Route::get('/lahan', function () {
    return view('pages.lahan', ['title' => 'Pemanfaatan Lahan Pertanian']);
});
Route::get('/penanaman-padi', function () {
    return view('pages.penanaman-padi', ['title' => 'Penanaman benih padi']);
});
Route::get('/varietas/getall', [VarietasController::class, 'getall'])->name('varietas.getall');
//testimoni
Route::get('/testimoni/getall', [TestimoniController::class, 'getall'])->name('testimoni.getall');
Route::post('/testimoni/store',  [TestimoniController::class, 'store'])->name('testimoni.store');

Route::get('/penangkars/getall',  [PenangkarController::class, 'getAll'])->name('penangkars.getall');
Auth::routes();
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //add penangkar
    Route::post('/penangkars/store',  [PenangkarController::class, 'store'])->name('penangkars.store');
    //pengajuan Sertifikasi
    Route::get('/sertifikasi', [SertifikasiController::class, 'getData'])->name('sertifikasi.get');
    Route::post('/sertifikasi/store',  [SertifikasiController::class, 'store'])->name('sertifikasi.store');
    Route::get('/sertifikasi/pengajuan',  [SertifikasiController::class, 'pengajuan'])->name('sertifikasi.pengajuan');
});
Route::middleware(['auth:web', 'role:Penangkar'])->group(function () {
});
Route::middleware(['auth:web', 'role:BPSB,Dinas'])->group(function () {
    //penangkar managemen
    Route::get('/penangkars', [PenangkarController::class, 'index'])->name('penangkars');
    Route::get('/penangkars/edit/{id}',  [PenangkarController::class, 'edit'])->name('penangkars.edit');
    Route::delete('/penangkars/delete/{id}',  [PenangkarController::class, 'destroy'])->name('penangkars.delete');
    Route::get('/penangkars-datatable', [PenangkarController::class, 'getPenangkarsDataTable']);
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //testimoni
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
    Route::get('/testimoni-datatable', [TestimoniController::class, 'getTestimoniDataTable']);
    Route::delete('/testimoni/delete/{id}',  [TestimoniController::class, 'destroy'])->name('testimoni.delete');
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
