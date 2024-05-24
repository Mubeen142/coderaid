<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoreController;

Route::get('/', [CoreController::class, 'index'])->name('index');

Route::prefix('session')->group(function () {
    Route::get('/create', [CoreController::class, 'createSession'])->name('session.create');
    Route::get('/{session:token}', [CoreController::class, 'viewSession'])->name('session.view');
});