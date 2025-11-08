<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\departmentsController;
use App\Http\Controllers\Api\studentController;

Route::prefix('departments')->group(function () {
    Route::get('/', [departmentsController::class, 'index']);
    Route::get('/{id}', [departmentsController::class, 'show']);
    Route::post('/', [departmentsController::class, 'store']);
    Route::put('/{id}', [departmentsController::class, 'update']);
    Route::delete('/{id}', [departmentsController::class, 'destroy']);
    Route::get('{id}/subdepartments', [departmentsController::class, 'subdepartments']);
});

// Route::get('/students/{id}', function () {
//     return 'obteniendo un estudiante';
// });

// Route::post('/students', function () {
//     return 'creando estudiantes';
// });

// Route::put('/students/{id}', function () {
//     return 'actualizando estudiantes';
// });

// Route::delete('/students/{id}', function () {
//     return 'eliminando estudiantes';
// });
