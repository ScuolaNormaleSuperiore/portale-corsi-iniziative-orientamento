<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Api\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    function login (Request $request) {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details',
                'params' => $request->all(),
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        if (!$user->hasRole(['ApiUser'])) {
            $user->tokens()->where('id', $user->currentAccessToken())->delete();
            return response()->json([
                'message' => 'Invalid login details',
                'params' => $request->all(),
            ], 401);
        }
        $token = $user->createToken(
                'auth_token' //,['*'], now()->addWeek()
        )->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ]);
    }

    function logout (Request $request) {
        $user =  $request->user();
        $user->tokens()->where('id', $user->currentAccessToken())->delete();
    }
}
