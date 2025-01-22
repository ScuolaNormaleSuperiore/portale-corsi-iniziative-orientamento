<?php

namespace App\Listeners;

use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        $userData = [
            'id' => $samlUser->getUserId(),
            'attributes' => $samlUser->getAttributes(),
            'assertion' => $samlUser->getRawSamlAssertion()
        ];
        Log::info('SAML User authenticated', $userData);
        // Find the user in your database using their SAML ID or attributes
        $user = User::where('email', $userData['attributes']['urn:oid:0.9.2342.19200300.100.1.1'][0] ?? null)->first();

        if ($user) {
            // Login the user
            Auth::login($user);
            return redirect(RouteServiceProvider::CANDIDATURE);
        } else {
            // Generate a random password
            $randomPassword = Str::random(12);
            // Create a new user in your database
            $user = User::create([
                'name' => $userData['attributes']['urn:oid:0.9.2342.19200300.100.1.1'][0] ?? null,
                'email' => $userData['attributes']['urn:oid:0.9.2342.19200300.100.1.1'][0] ?? null,
                'password' => \bcrypt($randomPassword),
                'nome' => $userData['attributes']['urn:oid:2.5.4.42'][0] ?? null,
                'cognome' => $userData['attributes']['urn:oid:2.5.4.4'][0] ?? null,
            ]);
            Auth::login($user);
            return redirect(RouteServiceProvider::CANDIDATURE);
        }
    }
}
