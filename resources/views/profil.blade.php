@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Profil Saya</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <!-- Menampilkan foto profil -->
                <img src="{{ asset('storage/profile_pictures/' . (Auth::user()->profile_picture ?? 'default.jpg')) }}" 
                     alt="Foto Profil" 
                     class="img-fluid rounded-circle" 
                     width="150" 
                     height="150" 
                     id="profileImage">

                <!-- Tombol Edit Foto -->
                <button class="btn btn-primary mt-3" id="editProfilePictureBtn">Edit Foto Profil</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Foto Profil -->
<div class="modal fade" id="editProfilePictureModal" tabindex="-1" aria-labelledby="editProfilePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilePictureModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Pilih Foto Profil</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Menampilkan modal saat tombol "Edit Foto Profil" diklik
    document.getElementById('editProfilePictureBtn').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('editProfilePictureModal'));
        myModal.show();
    });
</script>
@endsection
