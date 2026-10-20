<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
{
    $data = $request->validated();

    if (! Auth::attempt([
        'email' => $data['email'],
        'password' => $data['password'],
        'is_admin' => true,
    ])) {
        return back()
            ->withErrors([
                'email' => 'Invalid admin credentials.',
            ])
            ->withInput();
    }

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
