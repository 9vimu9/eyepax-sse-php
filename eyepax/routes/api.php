<?php

use App\Http\Controllers\API\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(MemberController::class)->prefix("/members")->name("api.")->group(function () {
    Route::get('', 'index')->name("members.index");
    Route::post('', 'store')->name("members.store");
    Route::put('/{id}', 'update')->name("members.update");
    Route::get('/{id}', 'show')->name("members.show");
    Route::delete('/{id}', 'destroy')->name("members.delete");
});
