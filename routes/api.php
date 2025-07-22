<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas da API 
Route::get('/budgets', [BudgetController::class, 'apiIndex']);
Route::get('/budgets/{id}', [BudgetController::class, 'apiShow']);
Route::post('/budgets', [BudgetController::class, 'apiStore']);
Route::put('/budgets/{id}', [BudgetController::class, 'apiUpdate']);
Route::delete('/budgets/{id}', [BudgetController::class, 'apiDestroy']);
