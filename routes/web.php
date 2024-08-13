<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\MyTaskController;
use App\Http\Controllers\SlashworkController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\CalController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Tes;

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
Route::get('/tes', [Tes::class, 'index']);

Route::get('/mytask', function () {
    return view('mytask/mytask');
})->middleware(['auth', 'verified'])->name('mytask');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(WorkspaceController::class)->group(function () {
    Route::get('/workspace', 'workspace' )->middleware('auth');
    Route::post('/workspace/storecode','joinGroup')->middleware('auth');
    Route::get('/workspace/isiform','isiDataKelompok')->middleware('auth');
    Route::post('/workspace/storeform','storeDataKelompok')->middleware('auth');
    Route::get('/workspace/overview/{id}','overviewKelompokGet')->middleware('auth');
    Route::post('/workspace/overview/{id}','overviewKelompokAdd')->middleware('auth');
});

Route::controller(MyTaskController::class)->group(function () {

    Route::get('/mytask/createtask','isiDataIndividu')->middleware('auth');
    Route::get('/mytask','mytask')->middleware('auth');
    Route::post('/mytask/storetask','storeDataIndividu')->middleware('auth');
    Route::get('/mytask/overview/{id}','overviewIndividuGet')->middleware('auth');
    Route::post('/mytask/overview/{id}','overviewIndividuAdd')->middleware('auth');
});

Route::controller(SlashworkController::class)->group(function () {
    Route::get('/workspace/slashwork/{id}', 'slashwork')->middleware('auth');
    Route::post('/workspace/hasilslash/{id}', 'hasilslash')->name('hasilslash')->middleware('auth');
});

Route::controller(ProgressController::class)->group(function () {
    Route::get('/workspace/progress/{id}', 'showProgress')->name('progress.show');
});

Route::controller(DokumenController::class)->group(function () {
    Route::get('/workspace/merger/{id}', 'merger')->name('uploadpage')->middleware('auth');
    Route::post('/workspace/merger', 'store')->name('uploadedfile.store')->middleware('auth');
});

Route::controller(CalController::class)->group(function () {
    Route::get('/calendar', [calController::class, 'calendarview'])->middleware('auth');
});


