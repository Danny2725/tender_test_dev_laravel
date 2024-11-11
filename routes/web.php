<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TenderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route cho các trang yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route cho danh sách Contractors
    Route::get('/contractors', [ContractorController::class, 'index'])->name('contractors.index');

    // Route cho danh sách Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');

    // Route cho trang tạo Tender
    Route::get('/tenders/create', [TenderController::class, 'create'])->name('tenders.create');

    Route::post('/tenders', [TenderController::class, 'store'])->name('tenders.store');



    Route::get('/tenders/{tender}/edit', [TenderController::class, 'edit'])->name('tenders.edit');
    Route::put('/tenders/{tender}', [TenderController::class, 'update'])->name('tenders.update');
    Route::delete('/tenders/{tender}', [TenderController::class, 'destroy'])->name('tenders.destroy');

});

require __DIR__.'/auth.php';