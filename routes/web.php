<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\ShowRoomController;
=======
>>>>>>> a33233698159e94a55f4d165728bde9a4dfe18f5
use Laravel\Jetstream\Http\Controllers\Inertia\CurrentUserController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
<<<<<<< HEAD

    // Route::get('/dashboard', function () {return view('admin.index');})->name('dashboard');
    Route::get('admin/showroom',[ShowRoomController::class,'index'])->name('admin.car_showroom');
    Route::post('/admin/store/card_part_kind_price', [ShowRoomController::class, 'storeCardPartKindPrice'])->name('admin.store.card_part_kind_price');
    Route::put('admin/update/carparts/{id}', [ShowRoomController::class, 'update'])->name('admin.update.carparts');
    Route::delete('/admin/carparts/{id}', [ShowRoomController::class, 'destroy'])->name('admin.delete.carparts');
    // routes/web.php




=======
>>>>>>> a33233698159e94a55f4d165728bde9a4dfe18f5
});
Route::get('user/logout',[AdminController::class,'destroy'])->name('user.logout');
