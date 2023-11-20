<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
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

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('base');
    Route::get('index', [DashboardController::class, 'index'])->name('index');
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('deposit', [DepositController::class, 'index'])->name('deposit');
    Route::post('deposit', [DepositController::class, 'deposit'])->name('deposit.post');

    Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw');
    Route::post('withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw.post');

    Route::get('transfer', [TransferController::class, 'index'])->name('transfer');
    Route::post('transfer', [TransferController::class, 'transfer'])->name('transfer.post');

    Route::get('statement', [StatementController::class, 'index'])->name('statement');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


//require __DIR__.'/auth.php';
