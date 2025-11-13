<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Persona; // tu modelo
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SocialLoginController extends Controller
{
    // 1) Redirige a Google
    public function redirectToGoogle()
    {
        
        
        return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])   // clave
        ->redirect();
        
    }

    // 2) Callback de Google
    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        try {
            
            $google = Socialite::driver('google')->user(); 
        } catch (\Throwable $e) {
            
            return redirect('login')->withErrors(['google' => 'No se pudo iniciar sesión con Google.']);
        }

        // Emails 
        $email = $google->getEmail();
        if (!$email) {
            return redirect('login')->withErrors(['google' => 'Tu cuenta de Google no tiene email público.']);
        }

     
        $user = Persona::where('email', $email)->first();

        //Crea !== existe
        if (!$user) {
            // separa
            $fullName = trim($google->getName() ?: '');
            $parts = preg_split('/\s+/', $fullName, -1, PREG_SPLIT_NO_EMPTY);
            $name = $parts[0] ?? 'Usuario';
            $lastname = count($parts) > 1 ? trim($parts[count($parts)-1]) : '';

            $user = Persona::create([
                'name'       => $name,
                'lastname'   => $lastname,
                'email'      => $email,
                'password'   => Hash::make(Str::random(40)), // tu columna no permite null
                'type'       => '0',
                'ban'        => 0,
                'verify'     => '1', // tu tabla usa varchar(5) con default 1
                'google_id'  => $google->getId(),
                'avatar'     => $google->getAvatar(),
                'provider'   => 'google',
                // Opcionales que tienes: cell, ciudad, etc. los dejamos null
            ]);

            // Marca verificado si Google lo confirma
            $raw = $google->user ?? [];
            if (($raw['email_verified'] ?? false) && !$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }
        } else {
            // Actualiza vínculo con Google si no estaba
            $user->google_id = $user->google_id ?: $google->getId();
            $user->avatar    = $google->getAvatar() ?: $user->avatar;
            $user->provider  = 'google';
            $user->save();
        }

        // Si está baneado, con todo respeto: puerta.
        if ((int)$user->ban === 1) {
            return redirect('login')->withErrors(['ban' => 'Tu cuenta está suspendida.']);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        // Respeta tu lógica de Redirect por type
        if ($user->type === "1") return redirect('admin/productos');
        if ($user->type === "2") return redirect('login-v');
        return redirect('usuario');
    }
}