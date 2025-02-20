<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
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

// User
Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/show/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/reservation/create/{id}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservation/index', [ReservationController::class, 'index'])->name('reservations.index');
Route::delete('/reservation/cancel/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel');


// Admin
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/delete/{id}', [RoomController::class, 'delete'])->name('rooms.delete');
Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
Route::get('/admin', action: [RoomController::class, 'admin'])->name('admin.dashboard');
Route::post('/reservations/{id}/accept', [ReservationController::class, 'accept'])->name('reservations.accept');
Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
