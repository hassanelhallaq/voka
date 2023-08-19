<?php

use App\Http\Controllers\BranchAccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CasherController;
use App\Http\Controllers\ClientCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\LoungeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TableController;
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

Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(
    function () {
        Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
        Route::get('/change-lang/{language}', [App\Http\Controllers\DashboardController::class, 'changeLanguage'])->name('dashboard.change-language');
        Route::get('language_translate', [App\Http\Controllers\DashboardController::class, 'show_translate'])->name('show_translate');
        Route::post('/languages/key_value_store', [App\Http\Controllers\DashboardController::class, 'key_value_store'])->name('languages.key_value_store');
        Route::post('ajax/setting/status', [App\Http\Controllers\SettingController::class, 'ajaxSettingStatus'])->name('setting.status');
        Route::resource('branch', BranchController::class);
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/role.permissions', RolePermissionController::class);
        Route::resource('/permissions', PermissionController::class);
        Route::resource('/products', ProductController::class);
        Route::post('/branch-account/{id}', [BranchAccountController::class, 'store'])->name('branch-account.store');
        Route::get('/branch-account/{id}', [BranchAccountController::class, 'create'])->name('branch-account.create');
        Route::delete('/branch-account/{id}', [BranchAccountController::class, 'destroy'])->name('branch-account.destroy');
        Route::resource('coupons', CouponsController::class);
        Route::get('ajax/product/branches', [App\Http\Controllers\ProductController::class, 'ajaxProductBranches'])->name('product.ajax');
        Route::resource('packages', PackageController::class);
        Route::resource('cashers', CasherController::class);
        Route::get('finish-orders', [App\Http\Controllers\OrderController::class, 'finishOrders'])->name('finish_orders');
        Route::get('orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
        Route::get('reservations/all', [App\Http\Controllers\OrderController::class, 'reservations'])->name('reservations.all');
        Route::get('reservations-now/edit/{id}', [App\Http\Controllers\OrderController::class, 'editReservation'])->name('reservations.now.edit');
        Route::get('available-available/ajax', [App\Http\Controllers\OrderController::class, 'tableAvailable'])->name('table.available');
        Route::put('reservations-now/update/{id}', [App\Http\Controllers\OrderController::class, 'updateReservation'])->name('reservation.now.update');
        Route::get('backReservation/{id}', [App\Http\Controllers\OrderController::class, 'backReservation'])->name('backReservation');
        Route::resource('departments', DepartmentsController::class);
        Route::post('wallet-blance/{id}', [App\Http\Controllers\ClientController::class, 'walletBlance'])->name('wallet.blance');
        Route::get('reservations/refund', [App\Http\Controllers\OrderController::class, 'reservationsRefund'])->name('reservations.refund');


        Route::get('ajax/table/branches', [App\Http\Controllers\TableController::class, 'ajaxTableBranches'])->name('table.ajax');
        Route::post('ajax/package/status', [App\Http\Controllers\PackageController::class, 'ajaxPackageStatus'])->name('package.status');
        Route::get('/product', [DashboardController::class, 'product'])->name('product');
        Route::get('/lounge/{id}', [LoungeController::class, 'index'])->name('lounge.index');
        Route::post('/tables/{id}', [TableController::class, 'store'])->name('tables.store');
        Route::post('/lounge/{id}', [LoungeController::class, 'store'])->name('lounge.store');
        Route::resource('clients', ClientController::class);
        Route::resource('reservations', ReservationController::class);
        Route::resource('categories', ClientCategoryController::class);
        Route::get('/branch-account', [BranchAccountController::class, 'index'])->name('branch-account.index');
        Route::resource('shifts', ShiftController::class);
        Route::put('/branch-account/{id}', [BranchAccountController::class, 'update'])->name('branch-account.update');
        Route::get('/order-product', [OrderController::class, 'index'])->name('order-product');
        Route::put('/tables/{id}', [TableController::class, 'update'])->name('tables.update');
        Route::delete('/tables/{id}', [TableController::class, 'destroy'])->name('tables.destroy');
        Route::put('/update-reservation-time/{id}', [ReservationController::class, 'time'])->name('reservation.time');
    }
);

Route::prefix('branch')->middleware('auth:branch')->group(function () {
    Route::get('/home', [App\Http\Controllers\PosController::class, 'home'])->name('branch.home');
    Route::get('/branch/products', [App\Http\Controllers\PosController::class, 'products'])->name('branch.products');
    Route::get('/branch/_home', [App\Http\Controllers\PosController::class, '_home'])->name('branch._home');
    Route::get('/branch/halls', [App\Http\Controllers\PosController::class, 'halls'])->name('branch.halls');
    Route::get('/branch/reservation', [App\Http\Controllers\PosController::class, 'reservation'])->name('branch.reservation');
    Route::get('/branch/halls/ajax', [App\Http\Controllers\PosController::class, '_hallesBranch'])->name('branch.halls.ajax');
    Route::get('/clients/ajax', [App\Http\Controllers\PosController::class, '_client'])->name('clients.ajax');
    Route::post('/clients', [ClientController::class, 'store'])->name('branch_client.store');
    Route::get('/packages/ajax', [App\Http\Controllers\PosController::class, 'packages'])->name('packages.ajax');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('branch.reservations.store');
    Route::get('/resver/ajax', [App\Http\Controllers\PosController::class, 'resver'])->name('resver.ajax');
    Route::get('/product-order/ajax/{id}', [App\Http\Controllers\PosController::class, 'productOrder'])->name('productOrder.ajax');
    Route::post('/order-product/store', [App\Http\Controllers\OrderProductController::class, 'store'])->name('order-product.store');
    Route::get('/table/slots/ajax', [App\Http\Controllers\PosController::class, 'tableSlots'])->name('tableSlots');
    Route::get('/casher/create', [App\Http\Controllers\PosController::class, 'casher'])->name('casher.create');
    Route::post('/casher/store', [App\Http\Controllers\CasherController::class, 'store'])->name('casher.store');
    Route::get('/branch/halls/new', [App\Http\Controllers\PosController::class, 'hallsNew'])->name('branch.halls.new');
    Route::get('/payment', [App\Http\Controllers\ReservationController::class, 'payment'])->name('payment');

    Route::post('/active/table/{id}', [App\Http\Controllers\PosController::class, 'activeTable'])->name('active.table');
    Route::post('/close/table/{id}', [App\Http\Controllers\PosController::class, 'closeTable'])->name('close.table');

    Route::get('/cal', [App\Http\Controllers\PosController::class, 'ajaxCalender'])->name('ajaxCalender');
    Route::get('/calendar', function () {
        return view('branch.reserv');
    })->name('calendar');
    Route::get('/path/to/branch.reservSide', [App\Http\Controllers\PosController::class, 'sideReser'])->name('sideReser.ajax');
});
Route::prefix('menu/{table_id}/{branch_id}')->group(function () {
    Route::get('/home', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.home');
    Route::get('/cart', [App\Http\Controllers\MenuController::class, 'cart'])->name('menu.cart');
    Route::get('/product/{id}', [App\Http\Controllers\MenuController::class, 'product'])->name('product.index');
    Route::post('/store-order', [App\Http\Controllers\MenuController::class, 'storeOrder'])->name('store.order');
    Route::get('/sucess-payments', [App\Http\Controllers\MenuController::class, 'paymentStatus'])->name('paymentStatus');
    Route::get('/faild-payments', [App\Http\Controllers\MenuController::class, 'faild'])->name('faild.payments');
});
Route::get('/time-slots', [ReservationController::class, 'index'])->name('time-slots.index')->middleware('auth:branch');


Route::get('/error', function () {
    abort(500);
});
Route::get('clear_cache', function () {

    \Artisan::call('storage:link');
    // \Artisan::call('composer require spatie/laravel-medialibrary');

    dd("Cache is cleared");
});
require __DIR__ . '/auth.php';
