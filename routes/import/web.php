<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employee', 'middleware' => 'auth'], function () {
    Route::get("/", [EmployeeController::class, 'index'])->name('employee.index');
    Route::post("/employee", [EmployeeController::class, 'import'])->name('employee.import');
});
