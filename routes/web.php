<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\WalikelasController; // Import the WalikelasController
use App\Http\Controllers\KelasController;

use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KasusPelanggaranController;
use App\Http\Controllers\LaporanKasusPelanggaranController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TahunAjaranController;
// use Illuminate\Routing\Route as RoutingRoute;

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

// Route group for authenticated users
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Pindahkan import ke dalam sini:
    Route::get('/kelas/import', [KelasController::class, 'showImportPage'])->name('kelas.import');
    Route::post('/kelas/import-proses', [KelasController::class, 'import'])->name('kelas.import.proses');
    // Resource routes for Walikelas
    Route::resource('walikelas', WalikelasController::class);
    Route::resource('kelas', KelasController::class);

    Route::resource('jenis_pelanggaran', JenisPelanggaranController::class);

    Route::post('/kelas/naik-kelas', [KelasController::class, 'naikKelas'])->name('kelas.naikKelas');
    Route::resource('siswa', SiswaController::class);
    Route::get('kelas/{id}/siswa', [KelasController::class, 'show'])->name('kelas.siswa');


    Route::get('/kasus-pelanggaran/create', [KasusPelanggaranController::class, 'create'])->name('kasus_pelanggaran.create');

    // Menyimpan kasus pelanggaran yang baru dibuat
    Route::post('/kasus-pelanggaran', [KasusPelanggaranController::class, 'store'])->name('kasus_pelanggaran.store');

    Route::resource('kesiswaan', KesiswaanController::class);
    // (Opsional) Menampilkan daftar kasus pelanggaran
    Route::get('/kasus-pelanggaran', [KasusPelanggaranController::class, 'index'])->name('kasus_pelanggaran.index');
    // (Opsional) Menghapus kasus pelanggaran
    Route::delete('/kasus-pelanggaran/{id_kasus}', [KasusPelanggaranController::class, 'destroy'])->name('kasus_pelanggaran.destroy');
    Route::get('kasus_pelanggaran/{id}', [KasusPelanggaranController::class, 'show'])->name('kasus_pelanggaran.show');
    Route::get('/laporan-kasus-pelanggaran', [LaporanKasusPelanggaranController::class, 'index'])->name('laporankasus_pelanggaran.index');

    Route::get('/cetak-pdf/{id}', [PDFController::class, 'generatePDF'])->name('cetak.pdf');
    Route::get('/print-kasus/{id}', [PDFController::class, 'cetak'])->name('cetak.plg');

    Route::resource('tahunajaran', TahunAjaranController::class);
    Route::post('/siswa/check-nisn', [SiswaController::class, 'checkNisn'])->name('siswa.checkNisn');







});

// Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

// Route::get('/cetak-pelanggaran', [PDFController::class, 'cetak']);





Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// web.php
Route::get('/send-wa/{id}', [KasusController::class, 'sendWa'])->name('send.wa');
// Route::put('/kasus/update-wa/{id}', [KasusController::class, 'updateWa'])->name('kasus.update_wa');
Route::put('/kasus/{id}/update-wa', [KasusController::class, 'updateWa'])->name('kasus.update_wa');

Route::get('/kasus/{id}/edit-wa', [KasusController::class, 'editWa'])->name('kasus.edit_wa');
Route::put('/kasus/{id}/update-wa', [KasusController::class, 'updateWa'])->name('kasus.update_wa');
// Route::get('/kasus/{id}/edit-wa', [KasusController::class, 'editWa'])->name('kasus.edit_wa');
// Route::put('/kasus/{id}/update-wa', [KasusController::class, 'updateWa'])->name('kasus.update_wa');

