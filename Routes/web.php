<?php
use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use Moayman\Mvc\Http\Route;



Route::get("/", [HomeController::class, 'index']);
Route::get("/signup", [RegisterController::class, 'index']);
Route::post("/signup", [RegisterController::class, 'store']);