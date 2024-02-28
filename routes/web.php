<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.index', compact(
//         'payment'
//     ));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', function () {
    return view('users.create');
})->middleware(['auth'])->name('user.create');

Route::get('/profile', [ProfileController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::post('/profile', [ProfileController::class, 'change_profile'])->middleware(['auth'])->name('profile.change_profile');

Route::get('/change-password', [ProfileController::class, 'password'])->middleware(['auth'])->name('change_password');
Route::post('/change-password', [ProfileController::class, 'change_password'])->middleware(['auth'])->name('change_password.change');


Route::middleware(['auth'])->resource('/admin', AdminController::class);
Route::middleware(['auth'])->resource('/user', UserController::class);
Route::middleware(['auth'])->resource('/alat', AlatController::class);
Route::middleware(['auth'])->resource('/penyewaan', PenyewaanController::class);
Route::middleware(['auth'])->resource('/keuangan', KeuanganController::class);
Route::middleware(['auth'])->resource('/crew', CrewController::class);
Route::middleware(['auth'])->resource('/event', EventController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/alat-maintenance', [AlatController::class, 'maintenance'])->middleware(['auth'])->name('alat.maintenance');
Route::get('/view-maintenance/{alat:id}/view', [AlatController::class, 'view_maintenance'])->middleware(['auth'])->name('alat.view_maintenance');
Route::get('/note_maintenance/{alat:id}/note', [AlatController::class, 'note_maintenance'])->middleware(['auth'])->name('note_maintenance');
Route::put('/update-maintenance/{alat:id}/update', [AlatController::class, 'update_maintenance'])->name('alat.update_maintenance');
Route::put('/penyewaan/{event:id}/update', [PenyewaanController::class, 'update_penyewaan'])->name('datasewa.update');
Route::post('alat/{alat:id}/ready', [AlatController::class, 'clear_maintenance'])->name('alat.ready');

//Route::post('transaction/{transaction:id}/approve', [TransactionController::class, 'approve'])->name('transaction.approve');
Route::get('booking/{id}', [AlatController::class, 'booking'])->middleware(['auth'])->name('alat.booking');
Route::post('booking/{id}', [AlatController::class, 'booking_store'])->middleware(['auth'])->name('alat.booking_store');
//Route::post('penyewaan/{event:id}/approve', [PenyewaanController::class, 'approve'])->name('penyewaan.approve');
Route::post('/penyewaan-approve', [PenyewaanController::class, 'approve'])->middleware(['auth'])->name('penyewaan.approve');
Route::post('penyewaan/{event:id}/cancel', [PenyewaanController::class, 'cancel'])->name('penyewaan.cancel');
//Route::post('penyewaan/{event:id}/kembali', [AlatController::class, 'kembali'])->name('penyewaan.kembali');
Route::post('/penyewaan-kembali', [AlatController::class, 'kembali'])->middleware(['auth'])->name('penyewaan.kembali');
Route::get('bayarAlat/{id}', [KeuanganController::class, 'bayar'])->middleware(['auth'])->name('keuangan.bayar');
Route::post('bayarAlat/{id}', [KeuanganController::class, 'bayarAlat_store'])->middleware(['auth'])->name('bayarAlat.store');
Route::get('pelunasanAlat/{id}', [KeuanganController::class, 'pelunasanAlat'])->middleware(['auth'])->name('keuangan.pelunasan');
Route::post('pelunasanAlat/{id}', [KeuanganController::class, 'pelunasanAlat_store'])->middleware(['auth'])->name('pelunasanAlat.store');
//Route::post('usedcar/{transaction:id}/status', [UsedCarsController::class, 'status'])->name('usedcar.status');

Route::get('/downpayment', [KeuanganController::class, 'downpayment'])->middleware(['auth'])->name('keuangan.downpayment');
Route::get('/alat-tersedia', [AlatController::class, 'available'])->middleware(['auth'])->name('alat.tersedia');
Route::get('/alat-terpakai', [AlatController::class, 'used'])->middleware(['auth'])->name('alat.terpakai');
Route::get('/riwayat-sewa', [AlatController::class, 'record'])->middleware(['auth'])->name('alat.riwayat');
Route::get('/riwayat-pembayaran', [KeuanganController::class, 'history'])->middleware(['auth'])->name('riwayat.pembayaran');
Route::get('/bukti-bayar', [CetakController::class, 'buktibayar'])->middleware(['auth'])->name('cetak.buktibayar');
Route::get('/preview-bukti-bayar-alat/{id}', [CetakController::class, 'prevBuktiBayarAlat'])->middleware(['auth'])->name('cetak.previewbuktibayaralat');
Route::get('/cetak-bukti-bayar-alat/{id}', [CetakController::class, 'cetakBuktiBayarAlat'])->middleware(['auth'])->name('print.buktibayaralat');
Route::get('/preview-bukti-bayar-event/{id}', [CetakController::class, 'prevBuktiBayarEvent'])->middleware(['auth'])->name('cetak.previewbuktibayarevent');
Route::get('cetak-bukti-bayar-event/{id}', [CetakController::class, 'cetakBuktiBayarEvent'])->middleware(['auth'])->name('print.buktibayarevent');

Route::get('/surat-jalan', [CetakController::class, 'suratjalan'])->middleware(['auth'])->name('cetak.suratjalan');
Route::get('/preview-surat-jalan-event/{id}', [CetakController::class, 'prevSuratJalanEvent'])->middleware(['auth'])->name('cetak.previewsuratjalanevent');
Route::get('/cetak-surat-jalan-event/{id}', [CetakController::class, 'cetakSuratJalanEvent'])->middleware(['auth'])->name('print.suratjalanevent');
Route::get('/preview-surat-jalan-alat/{id}', [CetakController::class, 'prevSuratJalanAlat'])->middleware(['auth'])->name('cetak.previewsuratjalanalat');
Route::get('/cetak-surat-jalan-alat/{id}', [CetakController::class, 'cetakSuratJalanAlat'])->middleware(['auth'])->name('print.suratjalanalat');
Route::get('/laporan-alat', [LaporanController::class, 'alat'])->middleware(['auth'])->name('laporan.alat');
Route::get('/laporan-client', [LaporanController::class, 'client'])->middleware(['auth'])->name('laporan.client');
Route::get('/laporan-pembayaran', [LaporanController::class, 'pembayaran'])->middleware(['auth'])->name('laporan.pembayaran');

Route::get('event-tambah-alat/{id}', [EventController::class, 'eventAlat'])->middleware(['auth'])->name('event.alat');
Route::match(['get', 'post'], 'tambah-alat/{event_id}/{alat_id}', [EventController::class, 'tambahAlat'])->middleware(['auth'])->name('event.tambahAlat');
Route::get('event-tambah-crew/{id}', [EventController::class, 'eventCrew'])->middleware(['auth'])->name('event.crew');
Route::match(['get', 'post'], 'tambah-crew/{event_id}/{crew_id}', [EventController::class, 'tambahCrew'])->middleware(['auth'])->name('event.tambahCrew');
Route::get('/eventberjalan', [EventController::class, 'eventBerjalan'])->middleware(['auth'])->name('event.berjalan');
Route::get('/event-riwayat', [EventController::class, 'eventRiwayat'])->middleware(['auth'])->name('event.riwayat');
Route::post('submit-tambah-alat/{id}', [EventController::class, 'submitTambahAlat'])->middleware(['auth'])->name('event.submit');
Route::post('submit-tambah-crew/{id}', [EventController::class, 'submitTambahCrew'])->middleware(['auth'])->name('event.submitCrew');
Route::post('/event-approve', [EventController::class, 'approved'])->middleware(['auth'])->name('event.approve');
Route::post('event-cancel/{id}', [EventController::class, 'canceled'])->middleware(['auth'])->name('event.cancel');
Route::get('konfirmasi-event-selesai/{id}', [EventController::class, 'konfirmasiSelesai'])->middleware(['auth'])->name('event.konfirmasi');
Route::post('event-selesai/{id}', [EventController::class, 'eventSelesai'])->middleware(['auth'])->name('event.selesai');
Route::get('konfirmasi-event-batal/{id}', [EventController::class, 'konfirmasiBatal'])->middleware(['auth'])->name('event.konfirmbatal');


//Route::delete('detele-tambah-alat/{id}', [EventController::class, 'deleteTambahAlat'])->middleware(['auth'])->name('event.deleteAlat');
Route::match(['get', 'delete'], 'delete-tambah-alat/{event_id}/{toolEvents_id}', [EventController::class, 'deleteTambahAlat'])->middleware(['auth'])->name('event.deleteAlat');
Route::match(['get', 'delete'], 'delete-tambah-crew/{event_id}/{crewEvents_id}', [EventController::class, 'deleteTambahCrew'])->middleware(['auth'])->name('event.deleteCrew');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::delete('admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::delete('crew/{id}', [CrewController::class, 'destroy'])->name('crew.destroy');
Route::delete('alat/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');
Route::delete('keuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
Route::delete('event-riwayat/{id}', [EventController::class, 'deleteRiwayat'])->name('event.hapusRiwayat');
Route::delete('event/{id}', [EventController::class, 'hapusEvent'])->name('event.hapus');



require __DIR__ . '/auth.php';
