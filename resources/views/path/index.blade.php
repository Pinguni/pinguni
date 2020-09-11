@extends('layouts.app')

@section('title', 'MyPath')

@section('head')
    
@endsection

@section('hero')
    <x-hero bg="https://cdn.pixabay.com/photo/2012/03/01/00/21/bridge-19513_1280.jpg" class="blank">
        @slot('class', 'short')
        <x-slot name='h1'>
            MyPath
        </x-slot>
    </x-hero>
@endsection

@section('content')




@endsection

