<?php

namespace App\Listeners;

use App\Models\User;
use Slides\Saml2\Events\SignedIn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $user = User::where('email', $userData['attributes']['email'][0] ?? null)->first();

        if ($user) {
            // Login the user
            Auth::login($user);
        } else {
            // Create a new user in your database
            $user = User::create([
                'name' => $userData['attributes']['name'][0] ?? null,
                'email' => $userData['attributes']['email'][0] ?? null,
            ]);
        }
    }
}
