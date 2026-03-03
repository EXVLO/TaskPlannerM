@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>

    <ul>
        <li><a href="{{ route('office.index') }}">Office</a></li>
        <li><a href="{{ route('appsettings') }}">Settings</a></li>
        <li><a href="{{ route('news') }}">News</a></li>
    </ul>
@endsection
