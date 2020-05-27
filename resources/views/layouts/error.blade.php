@extends('layouts.app')

@section('content')
    <div class = "box py-10">
        <div class = "text-6xl text-center">
            @yield('code')
        </div>

        <div class="text-center mt-10 text-xl">
            @yield('message')
        </div>
    </div>
@endsection