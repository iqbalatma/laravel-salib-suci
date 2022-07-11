<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\DetailGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(): Response
    {
        return response()->view("auth.login", [
            "title" => "Login"
        ]);
    }

    public function authenticate(LoginRequest $request)
    {
        $authenticated = $this->authService->authenticate($request);

        if ($authenticated) {
            return redirect()->route('dashboard');
        }

        return back()->with('loginFailed', 'Login failed ! Username or password incorrect !');
    }

    public function registration()
    {
        return response()->view("auth.register", [
            "title" => "Registration"
        ]);
    }

    //!validation
    public function storeRegistration(Request $request)
    {
        $dataStore = $request->input();
        $dataStore['password'] = Hash::make($dataStore['password']);

        $user = User::create($dataStore);
        if ($user) {
            DetailGuru::create(['user_id' => $user->id]);
            return redirect()->route('auth.login');
        }

        return back()->with('loginFailed', 'Register Failed');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
}
