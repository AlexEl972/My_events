<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialAuthController extends Controller
{
    /**
     * Redirige l'utilisateur vers le service d'authentification OAuth du fournisseur.
     *
     * @param  string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtient la réponse du fournisseur et gère les données de l'utilisateur.
     *
     * @param  string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $avatarUrl = $socialUser->avatar;
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', 'Une erreur s\'est produite lors de la connexion avec ' . ucfirst($provider));
        }
    
        $user = User::where('provider_id', $socialUser->getId())->where('provider', $provider)->first();
    
        if (!$user) {
            $user = User::create([
                'name'       => $socialUser->getName(),
                'email'      => $socialUser->getEmail(),
                'provider_id'=> $socialUser->getId(),
                'provider'   => $provider,
                'avatar'     => $avatarUrl 
            ]);
        } else {
            $user->avatar = $avatarUrl;
            $user->save();
        }
    
        Auth::login($user, true);
        return redirect()->intended('/');
    }
    
}
