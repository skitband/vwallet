<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wallet/transaction/{id}', [WalletController::class, 'walletTransaction'])->middleware('auth');
Route::get('/wallet/transactionlist/{id}', [WalletController::class, 'walletTransactionList'])->middleware('auth');

Route::resource('wallet', WalletController::class)->middleware('auth');

Route::get('/transactioncreate/{id}', [TransactionController::class, 'create_transaction_wallet'])->middleware('auth');
Route::resource('transaction', TransactionController::class)->middleware('auth');
