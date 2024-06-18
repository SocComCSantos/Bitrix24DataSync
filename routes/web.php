<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/import/{id}', [\App\Http\Controllers\ListingController::class, 'import']);