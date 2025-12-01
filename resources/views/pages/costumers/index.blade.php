@extends('layouts.app')

@section('title', 'Pelanggan')

@push('style')
<!-- CSS Libraries: Hanya perlu satu style untuk DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pelanggan</h1>
            <div class="section-header-button">
                <a href="{{ route('costumers.create') }}"
                    class="btn btn-primary"><i class="fas fa-user-plus"></i> <span>Tambah Pelanggan</span></a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Pelanggan</a></div>
                <div class="breadcrumb-item">Data Pelanggan</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Pelanggan</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table cell-border" id="vehicle-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Pemilik</th>
                                            <th>Brand & Model</th>
                                            <th>Tahun Pembelian</th>
                                            <th>Warna</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
{{-- Menggunakan dataTables.js standar. dataTables.bootstrap5.js tidak diperlukan jika tidak ada styling Bootstrap tambahan. --}}

<script src="{{ asset('js/page/features-posts.js') }}"></script>

<script>
    // Inisialisasi DataTables dengan terjemahan Bahasa Indonesia lengkap
    new DataTable('#vehicle-table', {
        paging: true,
        // Konfigurasi bahasa lengkap agar pesan "Tidak ada data" (zeroRecords) muncul dengan benar.
        language: {
            lengthMenu: "Tampilkan _MENU_ entri",
            zeroRecords: "Tidak ada data pelanggan yang ditemukan.", // Ini adalah kunci untuk mengatasi pesan kosong
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari total _MAX_ entri)",
        },
        lengthMenu: [
            [5, 10, 25, 50],
            [5, 10, 25, 50]
        ],
    });
</script>
@endpush