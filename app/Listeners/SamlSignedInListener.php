<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\RegistrazioneStudente;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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


        $externalLoginType = Arr::first(Arr::get($attributes,'externalIDPLoA',[]));
        switch ($externalLoginType) {

            case 'LoA2': //ATENEO
                $normalizedAttributes = [
                    'spidName' => Arr::get($attributes, 'urn:oid:2.5.4.42'),
                    'spidFamilyName' => Arr::get($attributes, 'urn:oid:2.5.4.4'),
                    'spidEmail' => Arr::get($attributes, 'urn:oid:0.9.2342.19200300.100.1.1'),
                    'externalIDPLoA' => $externalLoginType,
                ];
                break;
            default: //SPID (LoA3), CIE (?)
                $normalizedAttributes = $attributes;
                break;
        }

        $userData = [
            'id' => $samlUser->getUserId(),
            'attributes' => $normalizedAttributes,
            'assertion' => $samlUser->getRawSamlAssertion()
        ];
        Log::info('SAML User authenticated', $userData);

        $userEmail = Arr::get(Arr::get($normalizedAttributes, 'spidEmail'), 0);

        $user = $userEmail ? User::where('email', $userEmail)->first() : null;

        if ($user) {

            $info = $user->info;
            $info = array_merge($info, $normalizedAttributes);
            $user->info = $info;
            $user->save();
            // Login the user
            return $this->login($user);
        } elseif ($userEmail) {
            // Generate a random password
            $randomPassword = Str::random(12);
            // Create a new user in your database

            $userData = [
                'name' => $userEmail,
                'email' => $userEmail,
                'password' => \bcrypt($randomPassword),
                'nome' => implode(" ", Arr::get($normalizedAttributes, 'spidName')),
                'cognome' => implode(" ", Arr::get($normalizedAttributes, 'spidFamilyName')),
                'info' => $normalizedAttributes,
                'email_verified_at' => now()->toDateTimeString(),
            ];
            $user = User::create($userData);
            $user->assignRole('Studente');
            event(new Registered($user));
            return $this->login($user);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
            //NO EMAIL DA GESTIRE
        }
    }

    protected function login(User $user)
    {
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        request()->session()->regenerate();
        request()->session()->put('sanctum_token', $token);
        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended(route('verification.notice'));
        }

        if (auth_is_admin()) {
            return redirect()->intended('/dashboard');
        }
        return redirect()->intended(RouteServiceProvider::CANDIDATURE);
    }
}
