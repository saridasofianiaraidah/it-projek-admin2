@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
    <h1>Daftar Akun</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @foreach ($accounts as $account)
            <li>{{ $account->name }} - {{ $account->email }} - {{ $account->role }}</li>
        @endforeach
    </ul>
@endsection
