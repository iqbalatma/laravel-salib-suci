<?php

namespace App\Services;

use App\Models\TeacherDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
  public function authenticate($request): bool
  {
    $isRemember =  $request->input('rememberme') === 'on' ? true : false;
    $credentials = $request->validated();

    // check into database
    if (Auth::attempt($credentials, $isRemember)) {
      $request->session()->regenerate();
      return true;
    }

    return false;
  }

  public function storeRegistration($dataUser): bool
  {
    $dataUser['password'] = Hash::make($dataUser['password']);

    $user = User::create($dataUser);
    if ($user) {
      TeacherDetail::create(['user_id' => $user->id]);
      return true;
    }

    return false;
  }
}
