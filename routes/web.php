<?php

use Carbon\Carbon;
use App\Exports\PembayaranExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\sjn72Controller;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\ApController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TahunController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Bendahara\PembayaranController;
use App\Http\Controllers\Admin\AdminPembayaranController;

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
    return view('form');
});
Route::get('tesfisik', [FormController::class, 'tesfisik'])->name('tesfisik');
Route::post('tesfisik', [FormController::class, 'tesfisik_store'])->name('tesfisik.store');
Route::get('getSiswaById/{id}', [FormController::class, 'getSiswaById'])->name('getSiswaById');
//Route::get('/sjn72xyz', [sjn72Controller::class, 'sjn72xyz']);
//Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
Route::get('/cek',[AdminPembayaranController::class,'cek']);
Route::get('/status', [StatusController::class, 'index'])->name('status.home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/pendaftar/store', [FormController::class,'store'])->name('form.store');
Route::prefix('admin')->group(function() {
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('pendaftar', [PendaftarController::class,'index'])->name('pendaftar');
    Route::get('pendaftar/cari',[PendaftarController::class,'cari'])->name('caripendaftar');
    Route::get('pendaftar/hapus/{id}',[PendaftarController::class,'destroy'])->name('hapuspendaftar');
    Route::get('pendaftar/edit/{id}',[PendaftarController::class,'edit'])->name('editpendaftar');
    Route::get('pendaftar/list/{jurusan}', [PendaftarController::class,'perjurusan'])->name('perjurusan');
    Route::get('pendaftar/export/excel',[PendaftarController::class,'exportExcel'])->name('pendaftar.exportExcel');
    Route::put('pendaftar/update/{id}', [PendaftarController::class,'update'])->name('pendaftar.update');
    Route::get('ap', [ApController::class,'index'])->name('pendaftar_ap');
    Route::get('pondok', [PendaftarController::class,'pondok'])->name('pendaftar_pondok');
    Route::get('pembayaran', [AdminPembayaranController::class,'create'])->name('admin.pembayaran');
    Route::get('pembayaran-tkj', [AdminPembayaranController::class,'createtkj'])->name('admin.pembayaran.tkj');
    Route::get('pembayaran/exportExcel', function () {
        $date = Carbon::now()->format('d-m-y-H-i');
        return Excel::download(new PembayaranExport, "pembayaran-{$date}.xlsx");
    })->name('pembayaran.exportExcel');
    Route::get('ta', [TahunController::class,'index'])->name('ta.index');
    Route::post('ta/create', [TahunController::class,'create'])->name('ta.create');
    Route::get('ta/{id}', [TahunController::class,'show'])->name('ta.show');
    Route::post('ta/store', [TahunController::class,'store'])->name('ta.store');

    Route::get('gelombang', [GelombangController::class,'index'])->name('gelombang.index');
    Route::post('gelombang/create', [Gelombangontroller::class,'create'])->name('gelombang.create');
    Route::get('gelombang/{id}', [GelombangController::class,'show'])->name('gelombang.show');
    Route::post('gelombang/store', [GelombangController::class,'store'])->name('gelombang.store');

    Route::get('history', [AdminPembayaranController::class,'history'])->name('admin.history');
    Route::get('laporan', [AdminPembayaranController::class,'laporan'])->name('admin.history.laporan');
});
Route::group(['middleware' => 'bendahara.access'], function () {
    Route::get('/pembayaran', [PembayaranController::class,'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create', [PembayaranController::class,'create'])->name('pembayaran.create');
    Route::get('/pembayaran/hapus/{id}', [PembayaranController::class,'destroy'])->name('pembayaran.hapus');
    Route::get('/pembayaran/history', [PembayaranController::class,'history'])->name('pembayaran.history');
    Route::post('/pembayaran', [PembayaranController::class,'store'])->name('pembayaran.store');
});

