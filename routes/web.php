<?php

use App\Http\Controllers\TpController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('pdf', [TpController::class, 'userList']);
Route::get('exportToExcel', [TpController::class, 'exportUserListToExcel']);
Route::get('import', [TpController::class, 'import']);
Route::post('import', [TpController::class, 'import'])->name('import');