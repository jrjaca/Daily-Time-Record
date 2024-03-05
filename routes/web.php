<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\LocationController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LogsController::class, 'index']);
Route::post('/uploadFile', [LogsController::class, 'uploadFile'])->name('uploadFile');
//Route::post('/pipsConversion', [LogsController::class, 'pipsConversion'])->name('pipsConversion'); NOT USED. DIRECTLY FROM DTR_LOGS TABLE
Route::post('/pips-conversion', [LogsController::class, 'pipsConversionV2'])->name('pipsConversionV2'); //from DTR_LOGS_PIPS TABLE
Route::post('/pips-conversion-per-office', [LogsController::class, 'pipsConversionPerOffice'])->name('pipsConversionPerOffice'); //from DTR_LOGS_PIPS TABLE
Route::get('/generate-dtrby-year-month-pdf', [LogsController::class, 'generateDtrByYearMoPdf'])->name('generateDtrByYearMoPdf');
Route::get('/generate-dtrby-year-month-office-pdf', [LogsController::class, 'generateDtrByYearMoOfficePdf'])->name('generateDtrByYearMoOfficePdf');
Route::get('/generate-dtrby-year-month-idnumber-pdf', [LogsController::class, 'generateDtrByYearMoIdNumPdf'])->name('generateDtrByYearMoIdNumPdf');
Route::get('lhios-sections/show/{branchunitid}', [LocationController::class, 'getLhioSectionByBranchUnitId']);//->name('getLhioSectionByBranchUnitId');
Route::get('/update-dtr-form', [LogsController::class, 'updateDtrByIdNumberForm'])->name('updateDtrByIdNumberForm');
Route::get('/update-dtr', [LogsController::class, 'updateDtrByIdNumber'])->name('updateDtrByIdNumber');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
