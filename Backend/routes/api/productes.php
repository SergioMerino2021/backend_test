<?php

use App\Http\Controllers\ProducteController;
use Illuminate\Support\Facades\Route;

Route::get('/getAllProducts', [ProducteController::class,'getAllProducts']);

Route::get('/getOneProduct/{id}', [ProducteController::class,'getOneProduct']);

Route::post('/newProduct', [ProducteController::class,'newProduct']);

Route::put('/updateProduct', [ProducteController::class,'updateProduct']);
