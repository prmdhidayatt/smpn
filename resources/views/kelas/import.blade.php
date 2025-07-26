@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Import Data Kelas dari Excel</h3>

    {{-- Tombol Kembali --}}
    <a href="{{ route('kelas.index') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Data Kelas
    </a>

    {{-- Form Import --}}
    <form action="{{ route('kelas.import.proses') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Pilih File Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">
            <i class="fas fa-file-import mr-1"></i> Import Sekarang
        </button>
    </form>
</div>
@endsection
