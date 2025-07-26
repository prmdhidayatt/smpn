@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="role_user">Role</label>
            <select class="form-control" id="role_user" name="role_user">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" required>
        </div>

    
        <div class="form-group">
            <label for="nama_kesiswaan">Nama Kesiswaan</label>
            <input type="text" class="form-control" id="nama_kesiswaan" name="nama_kesiswaan" required>
        </div>

        <div class="form-group">
            <label for="jk_kesiswaan">Jenis Kelamin</label>
            <select class="form-control" id="jk_kesiswaan" name="jk_kesiswaan">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
