use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', function () {
return view('dashboard');
})->name('dashboard');

Route::middleware(['role:superadmin'])->group(function () {
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

Route::middleware(['role:karyawan,superadmin'])->group(function () {
Route::get('/produksi', [ProduksiController::class, 'index'])->name('produksi.index');
});

Route::middleware(['role:logistik,superadmin'])->group(function () {
Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pengiriman.index');
});

Route::middleware(['role:supplier,superadmin'])->group(function () {
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
});

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

});