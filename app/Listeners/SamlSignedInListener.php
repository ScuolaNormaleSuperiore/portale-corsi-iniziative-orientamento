<?php

namespace App\Listeners;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Arr;
use Slides\Saml2\Events\SignedIn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SamlSignedInListener
{
    /**
     * Handle the event.
     *
     * @param  SignedIn  $event
     * @return void
     */
    public function handle(SignedIn $event)
    {
        $messageId = $event->getAuth()->getLastMessageId();

        // Prevent replay attacks (implement your own logic if needed)

        $samlUser = $event->getSaml2User();
        $attributes = $samlUser->getAttributes();
        $userData = [
            'id' => $samlUser->getUserId(),
            'attributes' => $attributes,
            'assertion' => $samlUser->getRawSamlAssertion()
        ];
        Log::info('SAML User authenticated', $userData);

        $userEmail = Arr::get($attributes,'spidEmail');

        $user = $userEmail ? User::where('email', $userEmail)->first() : null;

        if ($user) {
            // Login the user
            $this->login($user);

        } elseif ($userEmail) {
            // Generate a random password
            $randomPassword = Str::random(12);
            // Create a new user in your database
            $user = User::create([
                'name' => $userEmail,
                'email' => $userEmail,
                'password' => \bcrypt($randomPassword),
                'nome' => Arr::get($attributes,'nome'),
                'cognome' => Arr::get($attributes,'cognome'),
                'info' => $attributes,
            ]);
            $user->assignRole($userData['role']);
            $this->login($user);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
            //NO EMAIL DA GESTIRE
        }
    }

    protected function login(User $user) {
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        request()->session()->regenerate();
        request()->session()->put('sanctum_token',$token);
        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended(route('verification.notice'));
        }

        if (auth_is_admin()) {
            return redirect()->intended('/dashboard');
        }
        return redirect()->intended(RouteServiceProvider::CANDIDATURE);
    }
}
