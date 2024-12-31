<?php 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Proteksi halaman dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    // Route untuk halaman profil
    Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
    Route::post('/profil/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
    
    
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::resource('accounts', AccountController::class);
    Route::resource('items', ItemController::class);
    Route::get('/items/cards', [ItemController::class, 'cards'])->name('items.cards');
    Route::resource('categories', CategoryController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('transactions', TransactionController::class);
    Route::post('/transactions/store-multiple', [TransactionController::class, 'storeMultiple'])->name('transactions.storeMultiple');
});

// Menambahkan rute untuk menyimpan barang dan kategori dari modal
Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

// routes/web.php
Route::post('/save-transaction-image', [TransactionController::class, 'saveImage'])->name('save.transaction.image');

Route::get('/TokoYulia', function () {
    return view('TokoYulia.index');
});
