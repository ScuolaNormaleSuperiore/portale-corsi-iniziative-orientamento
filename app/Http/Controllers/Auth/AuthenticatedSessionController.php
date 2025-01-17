<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{

    public function __construct()
    {
        Theme::set('sns');
    }


    public function meta()
    {
        return view('auth.login');
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login-classic');
    }

    public function createScuola()
    {
        return view('auth.login-scuola');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();
        $this->loginBySantum($request);

        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended(route('verification.notice'));
        }

        if (auth_is_admin()) {
            return redirect()->intended('/dashboard');
        }
        return redirect()->intended(RouteServiceProvider::CANDIDATURE);

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function loginBySantum($request) {
        $user = Auth::user();

        //$user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $request->session()->put('sanctum_token',$token);


//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'Bearer',
//            'name' => $user->name,
//            'email' => $user->email,
//            'role' => $user->mainrole
//        ]);
    }
}
