<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
       Route::get('/', [UserController::class, 'index']);
       Route::post('/logout', [UserController::class, 'logout']);
    });
});

Route::prefix('budgets')->middleware('auth:sanctum')->group(function () {
   Route::get('/', [BudgetController::class, 'index']);

   Route::post('/', [BudgetController::class, 'create']);
   Route::put('/{id}', [BudgetController::class, 'update']);
});

Route::prefix('categories')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [CategoryController::class, 'defaultCategories']);
    Route::get('/user', [CategoryController::class, 'userCategories']);
    Route::get('/user-savings', [CategoryController::class, 'userSavingsCategories']);

    Route::post('/', [CategoryController::class, 'create']);
    Route::post('/delete-multiple', [CategoryController::class, 'deleteMultiple']);

    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::put('/saving-goals/{id}', [CategoryController::class, 'updateGoal']);

    Route::delete('/{id}', [CategoryController::class, 'delete']);
});

Route::prefix('transactions')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TransactionController::class, 'list']);
    Route::get('/{id}', [TransactionController::class, 'show']);
    Route::get('/by-category/{category_id}', [TransactionController::class, 'listByCategory']);

    Route::post('/', [TransactionController::class, 'create']);
    Route::post('/delete-multiple', [TransactionController::class, 'deleteMultiple']);
    Route::post('/by-category/multiple', [TransactionController::class, 'listByMultipleCategories']);

    Route::put('/update-categories', [TransactionController::class, 'updateCategoriesForTransactions']);
    Route::put('/{id}', [TransactionController::class, 'update']);

    Route::delete('/{id}', [TransactionController::class, 'delete']);
});
