<?php

use App\Http\Controllers\LetterInController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    /**
     * route disposisi
     */
    Route::post("/naskah-masuk/disposisi", [LetterInController::class, 'disposisi'])->name("naskah-masuk.disposisi");
    /**
     * end route disposisi
     */
    // route forward
    Route::post('/naskah-masuk/forward', [LetterInController::class, 'forward'])->name('naskah-masuk.forward');
    Route::post('/naskah-masuk/alihkan', [LetterInController::class, 'alihkan'])->name('naskah-masuk.alihkan');
    Route::post('/naskah-masuk/receive', [LetterInController::class, 'receive'])->name('naskah-masuk.receive');
    // route teruskan
    Route::post("/naskah-masuk/teruskan", [LetterInController::class, 'teruskan'])->name("naskah-masuk.teruskan");
    //Route Naskah Masuk
    Route::get('/naskah-masuk/utama', [LetterInController::class, 'utama'])->name('naskah-masuk.utama');
    Route::get('/naskah-masuk/utama/{id}', [LetterInController::class, 'utamaShow'])->name('naskah-masuk.utama.show');
    Route::post('/naskah-masuk/send', [LetterInController::class, 'sendLetter'])->middleware('secretary');
    Route::post("/naskah-masuk/terima", [LetterInController::class, 'terima'])->name('naskah-masuk.terima');
    Route::post("/naskah-masuk/balas", [LetterInController::class, 'balas'])->name('naskah-masuk.balas');
    Route::post("/naskah-masuk/selesai", [LetterInController::class, 'selesai'])->name('naskah-masuk.selesai');
    Route::post("/naskah-masuk/tolak", [LetterInController::class, 'tolak'])->name('naskah-masuk.tolak');
    Route::post("/naskah-masuk/tangguhkan", [LetterInController::class, 'tangguhkan'])->name('naskah-masuk.tangguhkan');
    Route::resource('/naskah-masuk', LetterInController::class)->parameters(['naskah-masuk' => 'LetterIn']);
});
