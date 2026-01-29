@extends('layouts.app')

@section('title', 'Stok Spareparts')

@push('style')
{{-- Memastikan DataTables CSS dimuat --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Histori Stok</h1>
            <div class="section-header-button">
                <a href="{{ route('stock.createIn') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Stok Masuk
                </a>
                <a href="{{ route('stock.createOut') }}" class="btn btn-danger">
                    <i class="fas fa-minus"></i> Stok Keluar
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Spareparts</div>
                <div class="breadcrumb-item">Stok Spareparts</div>
            </div>
        </div>

        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Histori Stok Spareparts</h2>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Histori Stok Spareparts</h4>
                        </div>
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="customers-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Nama Spareparts</th>
                                            <th>Jumlah</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            {{-- Menghilangkan paginasi manual karena DataTables yang mengurus --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Memastikan jQuery dan DataTables JS dimuat --}}
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="{{ asset('js/page/index.js') }}"></script>
<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#customers-table').DataTable({
            // Konfigurasi Paging dan Length Menu
            paging: true,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],

            // Terjemahan Bahasa Indonesia
            language: {
                lengthMenu: "Tampilkan _MENU_ entri",
                zeroRecords: "Tidak ada data pelanggan yang ditemukan.",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(disaring dari total _MAX_ entri)",
                search: "Cari",

            },
            // Urutan default (opsional)
            order: [
                [0, 'asc']
            ],
        });
    });
</script>
@endpush