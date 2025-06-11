<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\SweepController;
use App\Http\Controllers\WalletController;
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
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/wallets', [DashboardController::class, 'wallets'])->name('wallets');
Route::get('/sweep-settings', [DashboardController::class, 'sweepSettings'])->name('sweep-settings');
Route::get('/payout', [DashboardController::class, 'payout'])->name('payout');
Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');



Route::resource('wallets', WalletController::class);
// payout controller
Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
Route::post('/payouts', [PayoutController::class, 'store'])->name('payouts.store');
Route::get('/payouts/{id}', [PayoutController::class, 'show'])->name('payouts.show');


// for  sweep controller
Route::get('/sweeps', [SweepController::class, 'index'])->name('sweeps.index');
Route::post('/wallets/{wallet}/sweep', [SweepController::class, 'sweep'])->name('sweeps.wallet');


// Route::get('sweep', [SweepController::class, 'index']);
// Route::post('sweep/trigger', [SweepController::class, 'trigger']);
// Route::resource('payouts', PayoutController::class);
// Route::get('settings', [SettingsController::class, 'index']);
// Route::post('settings', [SettingsController::class, 'store']);