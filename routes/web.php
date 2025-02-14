<?php

use App\Http\Controllers\BebanKinerjaDosenController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\EvaluasiPelaksanaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerjasamaPendidikanController;
use App\Http\Controllers\KerjasamaPenelitianController;
use App\Http\Controllers\KerjasamaPengabdianKepadaMasyarakatController;
use App\Http\Controllers\ProfilDosenController;
use App\Http\Controllers\VisiMisiController;
use App\Models\KerjasamaPenelitian;
use App\Models\KerjasamaPengabdianKepadaMasyarakat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.index');
});

Route::middleware(['auth','verified','user'])->group(function () {
    Route::get('/visimisi', [VisiMisiController::class, 'show'])->name('pages.visi_misi');
    Route::post('/visimisi', [VisiMisiController::class, 'add'])->name('pages.visi_misi.add');
    Route::put('/visimisi/{id}', [VisiMisiController::class, 'update'])->name('pages.visi_misi.update');
    Route::delete('/visimisi/{id}', [VisiMisiController::class, 'destroy'])->name('pages.visi_misi.destroy');

    Route::get('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'show'])->name('pages.kerjasama_pendidikan');
    Route::post('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'add'])->name('pages.kerjasama_pendidikan.add');
    Route::put('/kerjasamapendidikan/{id}', [KerjasamaPendidikanController::class, 'update'])->name('pages.kerjasama_pendidikan.update');
    Route::delete('/kerjasamapendidikan/{id}', [KerjasamaPendidikanController::class, 'destroy'])->name('pages.kerjasama_pendidikan.destroy');

    Route::get('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'show'])->name('pages.kerjasama_penelitian');
    Route::post('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'add'])->name('pages.kerjasama_penelitian.add');
    Route::put('/kerjasamapenelitian/{id}', [KerjasamaPenelitianController::class, 'update'])->name('pages.kerjasama_penelitian.update');
    Route::delete('/kerjasamapenelitian/{id}', [KerjasamaPenelitianController::class, 'destroy'])->name('pages.kerjasama_penelitian.destroy');

    Route::get('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'show'])->name('pages.kerjasama_pengabdian_kepada_masyarakat');
    Route::post('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'add'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.add');
    Route::put('/kerjasamapengabiankepadamasyarakat/{id}', [KerjasamaPengabdianKepadaMasyarakatController::class, 'update'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.update');
    Route::delete('/kerjasamapengabiankepadamasyarakat/{id}', [KerjasamaPengabdianKepadaMasyarakatController::class, 'destroy'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.destroy');

    Route::get('/profildosen', [ProfilDosenController::class, 'show'])->name('pages.profil_dosen');
    Route::post('/profildosen', [ProfilDosenController::class, 'add'])->name('pages.profil_dosen.add');
    Route::put('/profildosen/{id}', [ProfilDosenController::class, 'update'])->name('pages.profil_dosen.update');
    Route::delete('/profildosen/{id}', [ProfilDosenController::class, 'destroy'])->name('pages.profil_dosen.destroy');

    Route::get('/evaluasipelaksanaan', [EvaluasiPelaksanaanController::class, 'show'])->name('pages.evaluasi_pelaksanaan');
    Route::post('/evaluasipelaksanaan', [EvaluasiPelaksanaanController::class, 'add'])->name('pages.evaluasi_pelaksanaan.add');
    Route::put('/evaluasipelaksanaan/{id}', [EvaluasiPelaksanaanController::class, 'update'])->name('pages.evaluasi_pelaksanaan.update');
    Route::delete('/evaluasipelaksanaan/{id}', [EvaluasiPelaksanaanController::class, 'destroy'])->name('pages.evaluasi_pelaksanaan.destroy');

    Route::get('/bebankinerjadosen', [BebanKinerjaDosenController::class, 'show'])->name('pages.beban_kinerja_dosen');
    Route::post('/bebankinerjadosen', [BebanKinerjaDosenController::class, 'add'])->name('pages.beban_kinerja_dosen.add');
    Route::put('/bebankinerjadosen/{id}', [BebanKinerjaDosenController::class, 'update'])->name('pages.beban_kinerja_dosen.update');
    Route::delete('/bebankinerjadosen/{id}', [BebanKinerjaDosenController::class, 'destroy'])->name('pages.beban_kinerja_dosen.destroy');


});

Route::get('/diagram', [DiagramController::class, 'show'], function() {
    return view('pages.diagram_view');
})->middleware(['auth','verified','user'])->name('pages.diagram_view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

// Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
//     Route::get('', [VisiMisiController::class, 'index'])->name('pages.visi_misi');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard',[HomeController::class, 'index'])->
    middleware(['auth','admin']);