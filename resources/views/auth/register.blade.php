@extends('layouts.app')

@section('title', 'Register')

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
@endsection

@section('content')

<section class = "box">
    
    <h2>{{ __('Register') }}</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        @error('email')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
        
        <label for="username">{{ __('Username') }}</label>
        <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" />
        @error('username')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror

        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
        @error('password')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror

        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
        
        <br />
        
        <button type="submit" class= "float-right">
            {{ __('Register') }}
        </button>
    </form>
    
</section>


@endsection
