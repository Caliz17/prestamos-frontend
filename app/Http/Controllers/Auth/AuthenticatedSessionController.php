<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1️⃣ Enviar credenciales a la API
        $response = Http::post(env('API_URL') . '/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'email' => 'Credenciales inválidas. Verifica tu correo y contraseña.',
            ]);
        }

        // 2️⃣ Guardar token en sesión
        $token = $response->json()['access_token'];
        session(['api_token' => $token]);

        // 3️⃣ Obtener perfil del usuario desde la API
        $userResponse = Http::withToken($token)->get(env('API_URL') . '/me');

        if ($userResponse->failed()) {
            return back()->withErrors([
                'email' => 'No se pudo obtener la información del usuario desde la API.',
            ]);
        }

        $apiUser = $userResponse->json();
        session(['user' => $apiUser]);

        /**
         * 4️⃣ Buscar usuario localmente
         * Si NO existe → LO CREAMOS automáticamente
         */
        $localUser = User::where('email', $apiUser['email'])->first();

        if (!$localUser) {
            $localUser = User::create([
                'name'  => $apiUser['name'] ?? 'Usuario API',
                'email' => $apiUser['email'],
                'password' => bcrypt('password-temporal'), 
            ]);
        }

        // 5️⃣ Autenticar usuario localmente
        Auth::login($localUser);

        // 6️⃣ Regenerar sesión
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Eliminar token API
        session()->forget(['api_token', 'user']);

        return redirect('/');
    }
}
