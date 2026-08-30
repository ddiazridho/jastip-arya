<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::guard('admin')->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin-catalog.index');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah');
    }
}
