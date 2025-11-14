<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('reset-password/{token}', function (Request $request, $token) {
    $email = $request->query('email');
    
    if (!$email) {
        abort(400, 'Falta parámetro email');
    }
    
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $email
    ]);
})->name('password.reset-custom'); // Usa un nombre diferente

// Luego la ruta principal
Route::get('/', function () {
    return redirect()->route('login');
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