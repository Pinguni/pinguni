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

        <label for="first_name">{{ __('First Name') }}</label>
        <input id="first_name" type="text" class="@error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus />
        @error('first_name')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
        
        <label for="last_name">{{ __('Last Name') }}</label>
        <input id="last_name" type="text" class="@error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus />
        @error('last_name')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror

        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
        
        <label for="username">{{ __('Username') }}</label>
        <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />
        @error('username')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror

        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
        @error('password')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror

        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />

        
        <button type="submit" class= "float-right">
            {{ __('Register') }}
        </button>
    </form>
    
</section>


@endsection
