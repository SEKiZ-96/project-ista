<?php

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return redirect(backpack_url('dashboard'));
});
Route::get('/', function () {
    return redirect(backpack_url('dashboard'));
});