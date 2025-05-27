<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ExtraEquipmentController;
use App\Http\Controllers\UserRentalController;



Route::get('/', function () {
    $featuredCars = Car::where('featured', true)->get();
    return view('home', compact('featuredCars'));
})->name('home');

Route::get('/home', fn () => redirect('/'));

Route::get('/catalog', function () {
    $cars = Car::all();
    return view('catalog', compact('cars'));
})->name('catalog');

Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rent/{car}', [UserRentalController::class, 'create'])->name('user.rental.create');
    Route::post('/rent/{car}', [UserRentalController::class, 'store'])->name('user.rental.store');
    Route::get('/my-rentals', [UserRentalController::class, 'index'])->name('user.rentals.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/cars', CarController::class);
    Route::resource('/rentals', RentalController::class);
    Route::resource('/equipment', ExtraEquipmentController::class);
});

require __DIR__.'/auth.php';
