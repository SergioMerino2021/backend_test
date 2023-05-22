<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::post('/newClient', [ClientController::class,'newClient']);
Route::get('/getOneClient/{id}', [ClientController::class,'getOneClient']);
Route::get('/getAllClients', [ClientController::class,'getAllClients']);
Route::put('/updateClient', [ClientController::class,'updateClient']);
