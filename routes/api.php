<?php

use App\Http\Controllers\EggController;
use Illuminate\Support\Facades\Route;

Route::get('/eggs', [EggController::class, 'index']);
