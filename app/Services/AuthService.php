<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
  public function authenticate(Request $request): bool
  {
    $credentials = $request->validated();
    // check into database
    if (Auth::attempt($credentials, $request->input("rememberme"))) {
      $request->session()->regenerate();
      return true;
    }

    return false;
  }
}
