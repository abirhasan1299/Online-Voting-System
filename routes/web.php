<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

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

//===============================BASIC ROUTING============================

Route::get('/', [HomeController::class,"Home"])->name("home");
Route::get('login',[UserController::class,'Login'])->name('login');
Route::post('login-verification',[UserController::class,'LoginCheck'])->name('user.login');
Route::get('registration',[UserController::class,'Registration'])->name('registration');
Route::post('register',[UserController::class,'RegisterUser'])->name('register');

Route::post('logout',[UserController::class,'Logout'])->name('user.logout');

//==========================Portal (Election)=============================

Route::get('portal',[ElectionController::class,'Home'])->name('portal.home');
Route::get("portal/new-election",[ElectionController::class,'ElectionMaker'])->name('new-election');
Route::post('portal/save-election',[ElectionController::class,'createElection'])->name('save-election');
Route::get('portal/election',[ElectionController::class,'Election'])->name('election.home');
Route::get('portal/election/edit/{id}',[ElectionController::class,'ElectionEdit'])->name('election.editView');
Route::post('portal/election/save-edit/',[ElectionController::class,'Edit'])->name('election.save-edit');
Route::get('portal/election/delete/{id}',[ElectionController::class,'ElectionDelete'])->name('election.delete');

//===========================Portal (Candidate)============================
Route::resource('candidates',CandidateController::class);

//===========================User Routing===================================
Route::middleware([ValidUser::class])->group(function(){
    Route::get('user',[UserController::class,'Home'])->name('user.home');
    Route::get('user/edit/profile',[UserController::class,'ProfileEdit'])->name('user.profile-edit');
    Route::post('user/update/profile',[UserController::class,'ProfileUpdate'])->name('user.profile-updated');
    Route::get('user/profile',[UserController::class,'Profile'])->name('user.profile');
    Route::get('user/election/{id}',[UserController::class,'ElectionDetails'])->name('election.details');
    Route::post('vote-taken',[UserController::class,'VoteTaken'])->name('user.vote-taken');
    Route::get('user/result/{id}',[ElectionController::class,'ElectionResult'])->name('user.result');
});

