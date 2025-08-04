@extends('layouts.master')

@push('plugin-styles')
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Riwayat Pendataan</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Data Pendataan</li>
    </ol>
</nav>

@include('components.alert')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Data Pendataan</h6>
                <form class="forms-sample" action="{{ route('pendataan.update', $pendataan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="nama_bayi" class="form-label">Nama Bayi</label>
                        <input type="text" class="form-control @error('nama_bayi') is-invalid @enderror" id="nama_bayi" name="nama_bayi" value="{{ old('nama_bayi', $pendataan->nama_bayi) }}">
                        @error('nama_bayi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $pendataan->nama_ayah) }}">
                        @error('nama_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $pendataan->nama_ibu) }}">
                        @error('nama_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir_bayi" class="form-label">Tanggal Lahir Bayi</label>
                        <input type="date" class="form-control @error('tgl_lahir_bayi') is-invalid @enderror" id="tgl_lahir_bayi" name="tgl_lahir_bayi" value="{{ old('tgl_lahir_bayi', $pendataan->tgl_lahir_bayi) }}">
                        @error('tgl_lahir_bayi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pengecekan" class="form-label">Tanggal Pengecekan</label>
                        <input type="date" class="form-control @error('tgl_pengecekan') is-invalid @enderror" id="tgl_pengecekan" name="tgl_pengecekan" value="{{ old('tgl_pengecekan', $pendataan->tgl_pengecekan) }}">
                        @error('tgl_pengecekan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tb" class="form-label">Tinggi Badan</label>
                        <input type="text" class="form-control @error('tb') is-invalid @enderror" id="tb" name="tb" value="{{ old('tb', $pendataan->tb) }}">
                        @error('tb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="bb" class="form-label">Berat Badan</label>
                        <input type="text" class="form-control @error('bb') is-invalid @enderror" id="bb" name="bb" value="{{ old('bb', $pendataan->bb) }}">
                        @error('bb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jkel" class="form-label">Jenis Kelamin</label>
                        <select id="jkel" name="jkel"
                            class="form-select @error('jkel') is-invalid @enderror" data-width="100%">
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('jkel', $pendataan->jkel) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('jkel', $pendataan->jkel) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jkel')
                            <label for="jkel" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <a href="{{ route('pendataan.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endpush
