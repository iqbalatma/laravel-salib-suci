<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\auth\StoreRegistration;
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
            if (Auth::user()->role_id == 3) {
                return redirect()->route('dashboard');
            } else if (Auth::user()->role_id == 2) {
                return redirect()->route('user.teachers');
            } else {
                return redirect()->route('teacherDetail.profile');
            }
        }

        return back()->with('loginFailed', 'Login failed ! Username or password incorrect !');
    }

    public function registration()
    {
        return response()->view("auth.register", [
            "title" => "Registration"
        ]);
    }

    public function storeRegistration(StoreRegistration $request)
    {
        $registration = $this->authService->storeRegistration($request->validated());

        if ($registration) {
            return redirect()->route('auth.login');
        }

        return back()->with('loginFailed', 'Registration Failed');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
}
