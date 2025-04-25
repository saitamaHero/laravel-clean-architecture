<?php

use App\Core\Modules\InterfaceAdapters\ModuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/module', [ModuleController::class, 'store']);
