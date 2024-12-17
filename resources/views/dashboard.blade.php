@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <h2>Selamat datang, {{ Auth::user()->name }}!</h2>
    <p>Ini adalah halaman dashboard Anda.</p>
@endsection
