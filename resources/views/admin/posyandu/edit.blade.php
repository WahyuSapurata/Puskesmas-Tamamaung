@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posyandu.index') }}">Data Posyandu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Data Posyandu</h6>
                <form class="forms-sample" action="{{ route('posyandu.update', $posyandu->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="input_name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name" name="name" value="{{ old('name', $posyandu->name) }}" placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="input_email" name="email" value="{{ old('email', $posyandu->email) }}" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="input_password" name="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="input_nik" name="nik" value="{{ old('nik', $posyandu->nik) }}" placeholder="NIK">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="input_kelurahan" name="kelurahan" value="{{ old('kelurahan', $posyandu->kelurahan) }}" placeholder="Kelurahan">
                        @error('kelurahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_no_telp" class="form-label">No. Telp</label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="input_no_telp" name="no_telp" value="{{ old('no_telp', $posyandu->no_telp) }}" placeholder="No. Telp">
                        @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <a href="{{ route('posyandu.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(function() {
        $("#input_kd_bidang").select2();
        $("#input_kd_region").select2();
        $("#input_area").select2();
    });
</script>
@endpush
