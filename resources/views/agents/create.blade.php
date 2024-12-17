@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Tambah Agen</h1>

    <form action="{{ route('agents.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Agen</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('agents.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
