@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Bayi</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Data Bayi</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{ route('pendataan.cetak-report') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="printer"></i>
            Cetak
        </a>
    </div>
</div>

@include('components.alert')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Bayi</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Petugas Posyandu</th>
                                <th>Nama Bayi</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Tanggal Lahir Bayi</th>
                                <th>Umur Bayi</th>
                                <th>Tanggal Pengecekan</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Gizi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->nama_bayi }}</td>
                                <td>{{ $item->nama_ayah }}</td>
                                <td>{{ $item->nama_ibu }}</td>
                                <td>{{ $item->tgl_lahir_bayi }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_lahir_bayi)->diffInMonths(\Carbon\Carbon::now()) }} Bulan</td>
                                <td>{{ $item->tgl_pengecekan }}</td>
                                <td>{{ $item->tb }}</td>
                                <td>{{ $item->bb }}</td>
                                <td>{{ $item->jkel }}</td>
                                <td>
                                    @if ($item->status == 'BURUK')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                    @else
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
