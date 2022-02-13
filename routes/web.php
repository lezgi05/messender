<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
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
Route::middleware('auth')->group(function () {  
    Route::get('/name_surname', [AuthController::class, 'name_surname'])->name('add_name');
    Route::post('/name_surname/{id}', [AuthController::class, 'add_name_surname']);
    Route::get('/home', [MainController::class, 'welcome'])->name('home');
    Route::get('/friends', [MainController::class, 'friends'])->name('friends');
    Route::get('/chat/{id}', [MainController::class, 'chat'])->name('chat');
    Route::get('/search_friends', [MainController::class, 'search_friends'])->name('search_friends');
    Route::post('/message', [MainController::class, 'message']);
    Route::post('/friends/{id}', [MainController::class, 'new_friends']);
    Route::get('/settings', [MainController::class, 'settings']);
    Route::get('/personal', [AuthController::class, 'personal'])->name('personal');
    Route::get('/exit', [AuthController::class, 'exit']);
    Route::get('/exit_personal', [AuthController::class, 'exit_personal']);
    Route::post('/main_exit_personal/{id}', [AuthController::class, 'main_exit_personal']);
    Route::post('/avatar_exit_personal/{id}', [AuthController::class, 'avatar_exit_personal']);
    Route::get('/message/{id}', [MainController::class, 'chat_message']);
});

Route::get('/', [AuthController::class, 'sign_in'])->name('login');
Route::get('/registr', [AuthController::class, 'registr']);
Route::post('/reg', [AuthController::class, 'reg']);
Route::post('/login', [AuthController::class, 'login']);
