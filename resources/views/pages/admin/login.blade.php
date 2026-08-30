@extends('layouts.app')
@section('content')

    <div class="login-page">
        <main class="login-container">
 
            {{-- Brand / Header --}}
            <div class="login-brand">
                <h1 class="login-title">JastipArya</h1>
                <p class="login-subtitle">Admin Access </p>
            </div>
 
            {{-- Login Card --}}
            <div class="login-card">
 
                @if (session('error'))
                    <div class="form-error" style="margin-bottom: var(--space-md);">
                        {{ session('error') }}
                    </div>
                @endif
 
                <form method="POST" action="{{ route('admin-login.store') }}" class="login-form">
                    @csrf
 
                    {{-- Email --}}
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="admin@jastip.com"
                                value="{{ old('email') }}"
                                class="login-input @error('email') has-error @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
 
                    {{-- Password --}}
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <span class="material-symbols-outlined">lock</span>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="login-input @error('password') has-error @enderror"
                            >
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
 
                    {{-- Remember Me & Forgot Password --}}
                    <div class="login-options">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember-me" name="remember" class="checkbox-input">
                            <label for="remember-me" class="checkbox-label">Remember me</label>
                        </div>
                    </div>
 
                    {{-- Submit --}}
                    <button type="submit" class="btn-login">
                        Secure Login
                        <span class="material-symbols-outlined" style="margin-left: 8px; font-size: 20px;">login</span>
                    </button>
                </form>
            </div>
 
        </main>
    </div>


@endsection