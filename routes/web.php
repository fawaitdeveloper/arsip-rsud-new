<?php

use App\Helpers\FlowHelper;
use App\Helpers\LetterOutHelper;
use App\Http\Controllers\Ajax\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupDispotionController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\MainWorkUnitController;
use App\Http\Controllers\WorkUnitController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\MainPositionController;
use App\Http\Controllers\GroupPositionController;
use App\Http\Controllers\GroupPurposeController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\LetterAttributeController;
use App\Http\Controllers\LetterCategoryController;
use App\Http\Controllers\LetterInController;
use App\Http\Controllers\LetterOutController;
use App\Http\Controllers\LetterUrgencyController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SigningController;
use App\Http\Controllers\TranslucentController;
use App\Http\Controllers\VerificatorController;
use App\Libraries\Flow;
use Barryvdh\DomPDF\Facade\Pdf;


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

// Route untuk login
Route::get('/', function () {
    return view('login.login');
})->middleware('guest')->name('login');

Route::get('/testing', function () {
    // $flows = Flow::get(1, 33, 0);
    // dd($flows);
    // $test = LetterOutHelper::getPositionFlow(5, 16, 'Melalui');
    // dd($test);
    // $flow = new FlowHelper();
    // $result = $flow->where(3, 16)->unique()->sortBy()->get();
    // dd($result);
    // return view('dashboard.template-naskah.test');
    $pdf = Pdf::loadView('dashboard.template-naskah.test');
    return $pdf->download('nota-naskah.pdf');
    // return view('dashboard.template-naskah.surat-edaran');
    // $pdf = Pdf::loadView('dashboard.template-naskah.surat-edaran');
    // return $pdf->download('nota-naskah.pdf');
});

// route for ajax
Route::group(['prefix' => 'ajax'], function () {
    Route::get('user', [AjaxController::class, 'getUser'])->name('ajax.user');
});

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);

//Route Logout
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['middleware' => "auth"], function () {
    //Route Dashboard
    Route::resource('/dashboard', DashboardController::class)->middleware('role:user,secretary,admin');

    // letter category
    Route::resource('letter-category', LetterCategoryController::class)->middleware('admin');
    // letter-urgency
    Route::resource('letter-urgency', LetterUrgencyController::class)->middleware('admin');
    // letter attribute
    Route::resource('letter-attribute', LetterAttributeController::class)->middleware('admin');

    //Route Jabatan
    Route::resource('/jabatan', PositionController::class)->middleware('admin');

    //Route Induk Jabatan
    Route::resource('/induk-jabatan', MainPositionController::class)->middleware('admin');

    //Route Group Jabatan
    Route::resource('/grup-jabatan', GroupPositionController::class)->middleware('admin');

    //Route Main Work Unit
    Route::resource('/induk-unit-kerja', MainWorkUnitController::class)->middleware('admin');

    //Route Work Unit
    Route::resource('/unit-kerja', WorkUnitController::class)->middleware('admin');

    //Route User Category
    Route::resource('/user-category', UserCategoryController::class)->middleware('admin');

    //Route Create User
    Route::resource('/users', UserDetailController::class)->parameters(['user' => 'User'])->middleware('admin');

    // Route tujuan
    Route::resource('/purpose', PurposeController::class)->middleware('secretary');

    // Route penandatangan
    Route::resource('/signing', SigningController::class)->middleware('secretary');

    // route group purpose
    Route::resource('/group-purpose', GroupPurposeController::class)->middleware('secretary');

    // route group disposisi
    Route::resource('/group-disposition', GroupDispotionController::class)->middleware('secretary');

    // route verifikator
    Route::resource('/verificator', VerificatorController::class)->middleware('secretary');

    // route verifikator
    Route::resource('/translucent', TranslucentController::class)->middleware('secretary');

    // route job level
    Route::get("/job-level", [JobLevelController::class, 'index'])->middleware('admin');

    // route job position
    Route::get("/job-position", [JobPositionController::class, 'index'])->middleware('admin')->name('jobposition.index');

    // route setting
    Route::get('/profile-setting', [SettingController::class, 'get'])->name('profile-setting.get');
    Route::post('/profile-setting', [SettingController::class, 'post'])->name('profile-setting.post');

    // route reset password
    Route::get('/reset-password', [ResetPasswordController::class, 'get'])->name('reset-password.get');
    Route::post('/reset-password', [ResetPasswordController::class, 'post'])->name('reset-password.post');
});

require __DIR__ . '/letter-in/web.php';
require __DIR__ . '/letter-out/web.php';
require __DIR__ . '/user-monitoring/web.php';
require __DIR__ . '/import/web.php';
