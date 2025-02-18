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
use Illuminate\Support\Facades\Session;
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
        $attributes = $samlUser->getAttributesWithFriendlyName();

        Log::info($samlUser->getAttributesWithFriendlyName());


        $externalLoginType = Arr::first(Arr::get($attributes, 'externalIDPLoA', []));
        switch ($externalLoginType) {

            case 'LoA2': //ATENEO
                //{"cn":["Massimiliano Pardini"],"uid":["massimiliano.pardini@sns.it"],"externalIDPLoA":["LoA2"],"sn":["Pardini"],"givenName":["Massimiliano"]}

                $spidUid = Arr::get($attributes, 'uid', []);
                $userEmail = $this->getEmailFromField($spidUid);
                $userCf = null;
                if ($userEmail) {
                    $spidEmail = $spidUid;
                    $spidFiscalNumber = [];
                } else {
                    $spidFiscalNumber = $spidUid;
                    $spidEmail = [];
                    $userCf = Arr::first($spidUid);
                }

                $normalizedAttributes = [
                    'spidName' => Arr::get($attributes, 'cn'),
                    'spidFamilyName' => Arr::get($attributes, 'sn'),
                    'spidEmail' => $spidEmail,
                    'spidFiscalNumber' => $spidFiscalNumber,
                    'externalIDPLoA' => $externalLoginType,
                ];
                break;
            case 'LoA3': //
                Log::info('LoA3');

                $spidUid = Arr::get($attributes, 'uid', []);
                $userEmail = $this->getEmailFromField($spidUid);
                $userCf = Arr::first(Arr::get($attributes, 'spidFiscalNumber'));
                $normalizedAttributes = $attributes;

                break;
            default: //SPID (LoA3), CIE (?)
                Session::flash('redirect_url',RouteServiceProvider::LOGIN);
                Session::put('errors',["Metodo di atutenticazione non previsto"]);
                return;
        }

        $userData = [
            'id' => $samlUser->getUserId(),
            'attributes' => $normalizedAttributes,
            'assertion' => $samlUser->getRawSamlAssertion()
        ];
        Log::info('SAML User authenticated', $userData);


        $user = $userEmail ? User::where('email', $userEmail)->first() :
            ($userCf ? User::where('codice_fiscale', $userCf)->first() : null);

        if ($user) {
            //UTENTE RICONCILIATO: faccio il merge dei nuovi dati nelle info
            $info = $user->info;
            $info = array_merge($info, $normalizedAttributes);
            $user->info = $info;
            $user->save();
            // Login the user
            $this->login($user);
        }

        //UTENTE NON TROVATO MA HO TROVATO LA EMAIL
        if ($userEmail) {
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
                'codice_fiscale' => $userCf,
            ];
            Log::info('Utente creato', $userData);
            $user = User::create($userData);
            $user->assignRole('Studente');
            event(new Registered($user));
            Log::info('Provo ad effettuare il login...');
            $this->login($user);
        }

        //NON HO EMAIL, MA DOVREI ALMENO AVERE IL CODICE FISCALE

        $nome = Arr::first(Arr::get($normalizedAttributes, 'spidName'));
        $cognome = Arr::first(Arr::get($normalizedAttributes, 'spidFamilyName'));

        Session::flash('redirect_url',RouteServiceProvider::REGISTER_CIE);
        Session::put(['samlAttributes' => json_encode($normalizedAttributes),'nome' => $nome,'cognome' => $cognome,'codice_fiscale' => $userCf]);
        return;

    }

    protected function getEmailFromField($field)
    {
        $email = Arr::first(Arr::wrap($field));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return $email;
    }

    protected function login(User $user)
    {
        Auth::login($user);
        Log::info('Login fatto');
        $token = $user->createToken('auth_token')->plainTextToken;

        request()->session()->regenerate();
        Log::info('sessione rigenerata');

        request()->session()->put('sanctum_token', $token);
        Log::info('Token messo in sessione...');

        if (!Auth::user()->hasVerifiedEmail()) {
            Log::info('Mail non verificata??');

            Session::flash('redirect_url',route('verification.notice'));
            return ;
        }

        if (auth_is_admin()) {
            Session::flash('redirect_url','/dashboard');
            return ;
        }
        Log::info('Redirect...');

        Session::flash('redirect_url',RouteServiceProvider::CANDIDATURE);
        return;
    }
}
