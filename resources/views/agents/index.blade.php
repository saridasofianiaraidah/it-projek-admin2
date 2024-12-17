@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Kelola Agen</h1>
    <a href="{{ route('agents.create') }}" class="btn mb-3" style="background-color: #9fb873; color: white; border-color: #9fb873;">Tambah Agen</a>
    
    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Agen</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agents as $agent)
                    <tr>
                        <td>{{ $agent->id }}</td>
                        <td>{{ $agent->nama }}</td>
                        <td>{{ $agent->email }}</td>
                        <td>{{ $agent->telepon }}</td>
                        <td>
                            <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-warning">Ubah</a>
                            <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    window.onload = function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    };
</script>
@endsection
