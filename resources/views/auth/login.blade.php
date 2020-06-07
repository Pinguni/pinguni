@extends('layouts.app')

@section('title', 'Login')

@section('content')

<section class = "article">
    
    <div class = "box box-p bg-white">
        <h2>{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">{{ __('E-Mail Address') }}</label>
            <input 
                   id="email" 
                   type="email" 
                   class="@error('email') is-invalid @enderror" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="email" 
                   autofocus 
                   placeholder = "Email Address" />
            @error('email')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder = "Password"/>
            @error('password')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <div class = "flex">
                <div class = "w-1/2">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>

                <div class="w-1/2">
                    <button type="submit" class = "float-right">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>

            <br />
            <br />

            @if (Route::has('password.request'))
                <a class="w-1/2" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif


        </form>
    </div>
</section>
    
@endsection
