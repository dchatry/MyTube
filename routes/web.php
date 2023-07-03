<?php

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

Route::middleware(['splade'])->group(function () {
    Route::get('/', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('home');
    Route::get('/manage', [\App\Http\Controllers\SubscriptionController::class, 'manage'])->name('subscription.manage');
    Route::get('/{video}', [\App\Http\Controllers\VideoController::class, 'play'])->name('video.play');

    Route::spladeWithVueBridge();
    Route::spladeTable();
    Route::spladeUploads();
});
