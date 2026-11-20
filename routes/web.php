<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\Admin\InteresseController as AdminInteresseController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AmizadeController;
use App\Http\Controllers\ExplorarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding');
    Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'onboarding'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('eventos', EventoController::class);
    Route::post('/eventos/{evento}/participar', [EventoController::class, 'participar'])->name('eventos.participar');
    Route::delete('/eventos/{evento}/participar', [EventoController::class, 'sair'])->name('eventos.sair');
    Route::resource('comunidades', ComunidadeController::class)
        ->parameters(['comunidades' => 'comunidade']);
    Route::post('/comunidades/{comunidade}/entrar', [ComunidadeController::class, 'entrar'])->name('comunidades.entrar');
    Route::delete('/comunidades/{comunidade}/entrar', [ComunidadeController::class, 'sair'])->name('comunidades.sair');
        Route::get('/explorar', [ExplorarController::class, 'index'])->name('explorar');

    Route::get('/amigos', [AmizadeController::class, 'index'])->name('amigos.index');
    Route::post('/amigos/{usuario}', [AmizadeController::class, 'solicitar'])->name('amigos.solicitar');
    Route::patch('/amigos/{amizade}', [AmizadeController::class, 'aceitar'])->name('amigos.aceitar');
    Route::delete('/amigos/{amizade}', [AmizadeController::class, 'destroy'])->name('amigos.destroy');

    });

Route::middleware(['auth', 'onboarding', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('interesses', AdminInteresseController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['interesses' => 'interesse']);

    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
});

require __DIR__.'/auth.php';

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});