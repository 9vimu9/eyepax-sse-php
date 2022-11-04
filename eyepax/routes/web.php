<?php

use App\Http\Controllers\MemberController;
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


Route::controller(MemberController::class)->prefix("/members")->group(function () {
    Route::get('', 'index')->name("members.index");
    Route::post('', 'store')->name("members.store");
    Route::put('/{id}', 'update')->name("members.update");
});
