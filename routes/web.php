<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
// fronend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('dashboard', 'HomeController@index');
Route::get('/trang-chu', function () {
        return view('trangchu');
});
// backend
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/dashboard', action: [AdminController::class, 'show_dashboard'])->name('admin.show_dashboard');
Route::post('/admin-dashboard', [AdminController::class, 'truycap_dashboard'])->name('admin.truycap_dashboard'); // phuong thuc post lay du lieu tu form va xu li
Route::get('/dangxuat', action: [AdminController::class, 'dangxuat'])->name('admin.dangxuat');
 




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
