<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ClinicaController;

// Rotas de autenticação
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

// Rotas de produto
Route::middleware('auth:sanctum')->apiResource('produtos', ProdutoController::class);

// Rotas de serviço
Route::middleware('auth:sanctum')->apiResource('servicos', ServicoController::class);

// Rotas de clinica
Route::middleware('auth:sanctum')->apiResource('clinicas', ClinicaController::class);