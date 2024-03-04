<?php

use App\Http\Controllers\ProfileController;
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
    // return view('welcome');
    return route('home');
})->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return route('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('wahana.')->group(function () {
    Route::resource('wahana/paket', App\Http\Controllers\WahanaController::class);
    Route::get('wahana/paket/{id}/images', [App\Http\Controllers\WahanaController::class, 'images'])->name('paket.images');
    Route::post('wahana/paket/{id}/images/upload', [App\Http\Controllers\WahanaController::class, 'upload'])->name('paket.images.upload');
    Route::get('wahana/paket/{id}/images/load', [App\Http\Controllers\WahanaController::class, 'load_existing_images'])->name('paket.images.load');
    Route::get('wahana/paket/image/{id}', [App\Http\Controllers\WahanaController::class, 'show_image'])->name('paket.image.show');
    Route::delete('/wahana/paket/image/destroy/{id}', [App\Http\Controllers\WahanaController::class, 'destroy_image'])->name('paket.image.destroy');

    Route::resource('wahana/rooms', App\Http\Controllers\WahanaRoomController::class);
    Route::resource('wahana/facilities', App\Http\Controllers\WahanaFacilityController::class);


    Route::resource('wahana/monitoring', App\Http\Controllers\WahanaMonitoringController::class);
    Route::resource('wahana/kupon', App\Http\Controllers\WahanaKuponController::class);
    Route::resource('wahana/eo', App\Http\Controllers\EventOrganizerController::class);
});

Route::name('inventory.')->group(function () {
    Route::resource('inventory/kategori-produk', App\Http\Controllers\InventoryKategoriController::class);
    Route::resource('inventory/supplier', App\Http\Controllers\InventorySupplierController::class);
    Route::resource('inventory/produk', App\Http\Controllers\InventoryProdukController::class);
    Route::resource('inventory/purchasing', App\Http\Controllers\InventoryPurchasingController::class);
    Route::get('inventory/purchasing/detail/{id}', [App\Http\Controllers\InventoryPurchasingController::class, 'detail'])->name('purchasing.detail');

    Route::resource('inventory/stock', App\Http\Controllers\InventoryStockController::class);
});

Route::name('cms.')->group(function () {
    Route::get('cms/perusahaan', [App\Http\Controllers\CmsController::class, 'profile'])->name('perusahaan.profile');
    Route::get('cms/syarat-ketentuan', [App\Http\Controllers\CmsController::class, 'syarat_ketentuan'])->name('syarat-ketentuan');
    Route::get('cms/privacy-policy', [App\Http\Controllers\CmsController::class, 'privacy_policy'])->name('privacy-policy');
    Route::put('cms/update/{id}', [App\Http\Controllers\CmsController::class, 'update'])->name('update');

    Route::resource('cms/kontak', App\Http\Controllers\CmsKontakController::class);
    Route::resource('cms/faq', App\Http\Controllers\CmsFaqController::class);

    Route::resource('cms/kategori-artikel', App\Http\Controllers\CmsKategoriController::class);
    Route::resource('cms/artikel', App\Http\Controllers\CmsArtikelController::class);
});

Route::name('transaksi.')->group(function () {
    Route::resource('transaksi/cash-inventory', App\Http\Controllers\TransInventoryController::class);
    Route::get('transaksi/sales-inventory/slip/{id}', [App\Http\Controllers\TransInventoryController::class, 'receipt'])->name('sales-inventory.receipt');
    
    Route::resource('transaksi/cash-reservasi', App\Http\Controllers\TransReservasiOnsiteController::class);
    Route::get('transaksi/reservasi/slip/{id}', [App\Http\Controllers\TransReservasiOnsiteController::class, 'receipt'])->name('reservasi.receipt');
    Route::post('transaksi/reservasi/check_availability', [App\Http\Controllers\TransReservasiOnsiteController::class, 'check_availability'])->name('reservasi.check_availability');
    Route::get('reservasi/create/{tanggal}/{wahana_id}/{room_id}', [App\Http\Controllers\TransReservasiOnsiteController::class, 'create_with_params'])->name('reservasi.create.params');

    Route::resource('transaksi/cash-checkin', App\Http\Controllers\TransCheckinController::class);
    Route::resource('transaksi/cash-checkout', App\Http\Controllers\TransCheckoutController::class);
});

Route::name('tiket.')->group(function () {
    Route::resource('tiket/data', App\Http\Controllers\TiketController::class);
    Route::post('tiket/data/direct', [App\Http\Controllers\TiketController::class, 'store_direct'])->name('data.store_direct');
    Route::get('tiket/data/detail/{id}', [App\Http\Controllers\TiketController::class, 'detail'])->name('data.detail');

    Route::resource('tiket/terjual', App\Http\Controllers\TiketSaleController::class);
    Route::get('tiket/terjual/batch/{code}', [App\Http\Controllers\TiketSaleController::class, 'get_batch'])->name('terjual.get_batch');
    Route::get('tiket/terjual/create/{param}', [App\Http\Controllers\TiketSaleController::class, 'create_params'])->name('terjual.create_params');
    Route::post('tiket/terjual/store_direct', [App\Http\Controllers\TiketSaleController::class, 'store_direct'])->name('terjual.store_direct');
    Route::get('tiket/terjual/receipt/{id}', [App\Http\Controllers\TiketSaleController::class, 'receipt'])->name('terjual.receipt');
});

Route::name('acl.')->group(function () {
    Route::resource('acl/usergroup', App\Http\Controllers\UsergroupController::class);
    Route::get('acl/usergroup/detail/{id}', [App\Http\Controllers\UsergroupController::class, 'detail'])->name('usergroup.detail');

    Route::resource('acl/user', App\Http\Controllers\UserController::class);
});

Route::name('report.')->group(function () {
    Route::resource('report/lap-reservasi', App\Http\Controllers\ReportReservasiController::class);
    Route::resource('report/lap-inventory', App\Http\Controllers\ReportInventoryController::class);
    Route::resource('report/lap-parkir', App\Http\Controllers\ReportParkirController::class);
    Route::resource('report/lap-purchasing', App\Http\Controllers\ReportPurchasingController::class);
});

require __DIR__.'/auth.php';
