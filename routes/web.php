<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\LocationController;

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


Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');   // page load
Route::get('/leads/list', [LeadController::class, 'list'])->name('leads.list'); // datatable ajax
Route::post('/followup/store', [FollowUpController::class, 'store'])->name('followup.store');
Route::get('/leads/{id}/follow-up-form', [FollowUpController::class, 'followUpForm'])->name('leads.followup.form');

Route::get('/followup/{id}/edit', [FollowupController::class, 'edit'])->name('followup.edit');
Route::post('/followup/{id}/update', [FollowupController::class, 'update'])->name('followup.update');

Route::post('/stages/store', [StageController::class, 'store'])->name('stages.store');
Route::post('/source/store', [SourceController::class, 'store'])->name('source.store');
Route::post('/source/store', [SourceController::class, 'store'])->name('source.store');

Route::get('/leads/{lead}/followups', [FollowUpController::class, 'index'])->name('followup.index');


Route::get('/location',[LocationController::class,'index']);
Route::post('/get-states',[LocationController::class,'getStates'])->name('getStates');
Route::post('/get-cities',[LocationController::class,'getCities'])->name('getCities');



