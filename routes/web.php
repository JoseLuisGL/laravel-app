<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Rutas Controlador
Route::get('users/', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('users/{name}', [UserController::class, 'edit'])->name('users.edit');


//Vista
Route::get('/visitante', function () {
    return view('visitante');
});

//Operaciones
Route::get('/operacion/{tipo}/{n1}/{n2}', function ($tipo,$n1,$n2) {

    switch ($tipo) {
        case 'suma':
            $resultado = $n1 + $n2;
            break;
        case 'resta':
            $resultado = $n1 - $n2;
            break;   
        case 'multiplicacion':
            $resultado = $n1 * $n2;
            break;
        case 'division':
            $resultado = $n1 /  $n2;
            break;

        default:
            break;
    }

    return 'Resultado: '. $resultado;
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);

//Saludo
Route::get('/saludar/{name}/{lastname?}', function ($name,$lastname) {

    return 'Hola '. $name . $lastname;
})->where('name', '[A-Za-z]+');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
