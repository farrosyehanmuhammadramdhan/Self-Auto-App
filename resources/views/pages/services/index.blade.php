@extends('layouts.app')

@section('title', 'Data Servis')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Service</h1>
            <div class="section-header-button">
                <a href="{{ route('services.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah Service
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Service</a></div>
                <div class="breadcrumb-item">Data Service</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Services</h2>
            <p class="section-lead">
                You can manage all Services here.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Service</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Servis</th>
                                            <th>Kendaraan</th>
                                            <th>Pelanggan</th>
                                            <th>Teknisi</th>
                                            <th>Total Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr></tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>

@endpush