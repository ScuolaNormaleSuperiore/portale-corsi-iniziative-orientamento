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
     * @param SignedIn $event
     * @return void
     */
    public function handle(SignedIn $event)
    {

        $messageId = $event->getAuth()->getLastMessageId();

        // Prevent replay attacks (implement your own logic if needed)

        $samlUser = $event->getSaml2User();
        $attributes = $samlUser->getAttributes();


        $externalLoginType = Arr::first(Arr::get($attributes, 'externalIDPLoA', []));
        switch ($externalLoginType) {

            case 'LoA2': //ATENEO
                $spidEmail = Arr::get($attributes, 'urn:oid:0.9.2342.19200300.100.1.3', []);
                if (!filter_var(Arr::get($spidEmail, 0), FILTER_VALIDATE_EMAIL)) {
                    $spidEmail = Arr::get($attributes, 'urn:oid:0.9.2342.19200300.100.1.1', []);
                }
                $normalizedAttributes = [
                    'spidName' => Arr::get($attributes, 'urn:oid:2.5.4.42'),
                    'spidFamilyName' => Arr::get($attributes, 'urn:oid:2.5.4.4'),
                    'spidEmail' => $spidEmail,
                    'externalIDPLoA' => $externalLoginType,
                ];
                break;
            case 'LoA3': //
                Log::info('LoA3');

                $externalIDPType = Arr::first(Arr::get($attributes, 'externalIDPType', []));
                $normalizedAttributes = $attributes;
                if ($externalIDPType == 'cie') {
                    Log::info('cie');

                    $spidEmail = Arr::get($attributes, 'urn:oid:0.9.2342.19200300.100.1.3', []);
                    if (!filter_var(Arr::get($spidEmail, 0), FILTER_VALIDATE_EMAIL)) {
                        $spidEmail = Arr::get($attributes, 'urn:oid:0.9.2342.19200300.100.1.1', []);
                    }
                    $normalizedAttributes['spidEmail'] = $spidEmail;
                }
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
            Log::info('Devo creare un nuovo user');
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
            Log::info('Utente creato', $userData);
            $user = User::create($userData);
            $user->assignRole('Studente');
            event(new Registered($user));
            Log::info('Provo ad effettuare il login...');
            return $this->login($user);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
            //NO EMAIL DA GESTIRE
        }
    }

    protected function login(User $user)
    {
        Auth::login($user);
        Log::info('Login fatto');
        $token = $user->createToken('auth_token')->plainTextToken;
        Log::info('Token creato', $token);

        request()->session()->regenerate();
        Log::info('sessione rigenerata');

        request()->session()->put('sanctum_token', $token);
        Log::info('Token messo in sessione...');

        if (!Auth::user()->hasVerifiedEmail()) {
            Log::info('Mail non verificata??');

            return redirect()->intended(route('verification.notice'));
        }

        if (auth_is_admin()) {
            return redirect()->intended('/dashboard');
        }
        Log::info('Redirect...');

        return redirect()->intended(RouteServiceProvider::CANDIDATURE);
    }
}
