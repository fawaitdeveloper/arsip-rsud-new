<?php

use App\Http\Controllers\LetterOutController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    //Route Naskah keluar
    Route::post("/naskah-keluar/disposition", [LetterOutController::class, 'disposition'])->name('naskah-keluar.disposition');
    Route::post("/naskah-keluar/receive", [LetterOutController::class, 'receive'])->name('naskah-keluar.receive');

    Route::resource('/naskah-keluar', LetterOutController::class);
});
