<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PengembalianBukuController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
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

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function(){

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function(){
        Route::get('', 'dashboard')->name('dashboard');
    });

    Route::controller(BookController::class)->prefix('book')->group(function(){
        Route::get('', 'index')->name('book');
        Route::get('add', 'add')->name('book.add');
        Route::post('add', 'store')->name('book.add.store');
        Route::get('edit/{id}', 'edit')->name('book.edit');
        Route::post('edit/{id}', 'update')->name('book.add.update');
        Route::get('delete/{id}', 'delete')->name('book.delete');
    });

    Route::controller(MemberController::class)->prefix('member')->group(function(){
        Route::get('', 'index')->name('member');
        Route::get('add', 'add')->name('member.add');
        Route::post('add', 'store')->name('member.add.store');
        Route::get('edit/{id}', 'edit')->name('member.edit');
        Route::post('edit/{id}', 'update')->name('member.add.update');
        Route::get('delete/{id}', 'delete')->name('member.delete');
    });

    Route::controller(TransactionController::class)->prefix('transaction')->group(function(){
        // Route::get('', 'peminjamanBuku')->name('transaction');
        Route::get('', 'index')->name('transaction');
        Route::post('peminjaman-buku', 'store')->name('transaction.store');
        Route::post('peminjaman-buku/update-stok', 'updateStok')->name('transaction.update-stok');
    });

    Route::controller(PengembalianBukuController::class)->prefix('pengembalian-buku')->group(function(){
        Route::get('', 'index')->name('pengembalian-buku');
        Route::get('detail/{id}', 'detail')->name('pengembalian-buku.detail');
        Route::post('detail/{id}', 'update')->name('pengembalian-buku.detail.update');
        Route::delete('delete/{id}', 'delete')->name('pengembalian-buku.delete');
    });
});