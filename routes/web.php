<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlagiarismController;
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

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/', function () {
        return view('dashboard.index', ['title' => "Dashboard"]);
    });

    Route::get('/plagiarism', [PlagiarismController::class, 'index'])->name('plagiarism.index');
    Route::get('/plagiarism/{document}', [PlagiarismController::class, 'details'])->name('plagiarism.details');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
});
