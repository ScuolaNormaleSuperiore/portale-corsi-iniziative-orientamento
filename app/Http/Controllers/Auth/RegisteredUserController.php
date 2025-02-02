<?php

namespace App\Http\Controllers\Auth;

use App\Events\RichiestaScuola;
use App\Http\Controllers\Controller;
use App\Models\Provincia;
use App\Models\Scuola;
use App\Models\ScuolaRichiesta;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\ScuolaEmailRequired;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        Theme::set('sns');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:scuole,email_riferimento'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('Studente');
        $user->save();


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CANDIDATURE);
    }

    public function createScuola()
    {
        $province = [];
        $provinceStdList = (new Provincia())->getForSelectList();
        foreach ($provinceStdList as $optionValue => $optionLabel) {
            $province[] = [
                'value' => $optionValue,
                'label' => $optionLabel,
            ];
        }
        return view('auth.register-scuola',['province' => $province]);
    }

    public function storeScuola(Request $request)
    {

        $cambioEmail = $request->get('cambiaEmailButton');

        if ($cambioEmail) {
            $request->validate([
                'scuola_id' => ['required', 'exists:scuole,id'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'emailScuolaAggiornato' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:scuole,email_riferimento'],
            ]);
        } else {
            $request->validate([
                'scuola_id' => ['required', new ScuolaEmailRequired()],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

        }

        $scuola = Scuola::find($request->get('scuola_id'));
        if (!$cambioEmail) {

            $user = User::create([
                'name' => $scuola->email_riferimento,
                'email' => $scuola->email_riferimento,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            $user->assignRole('Scuola');
            $user->save();

            $scuola->user_id = $user->getKey();
            $scuola->save();
            Auth::login($user);
            return redirect(route('verification.notice'));
        } else {

            $scuolaRichiestaData = [
                'email' => $request->get('emailScuolaAggiornato'),
                'scuola_id' => $scuola->getKey(),
                'note' => $request->get('noteEmailScuola'),
                'password' => Hash::make($request->password),
            ];

            $richiestaScuola = ScuolaRichiesta::create($scuolaRichiestaData);
            if ($richiestaScuola) {
                $richiestaScuola->sendNuovaRichiestaNotification();
            }

            return redirect(route('cortesia-scuola-richiesta'));
        }




//
    }
}
