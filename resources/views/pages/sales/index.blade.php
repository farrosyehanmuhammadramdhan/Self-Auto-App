@extends('layouts.app')

@section('title', 'Data Penjualan')

@push('style')
{{-- Memastikan DataTables CSS dimuat --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penjualan</h1>
            <div class="section-header-button">
                <a href="{{ route('sales.create') }}" class="btn btn-primary">
                    Tambah Penjualan
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Data Penjualan</div>
            </div>
        </div>

        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Penjualan</h2>
            <p class="section-lead">
                Kelola data semua penjualan Anda di halaman ini.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Penjualan</h4>
                        </div>
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="sales-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Pelanggan</th>
                                            <th>Total</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $key => $sale)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $sale->invoice_number }}
                                                <div class="table-links">
                                                    <a href="#">Show</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Print</a>
                                                </div>
                                            </td>
                                            <td>{{ $sale->customer->name }}</td>
                                            <td>{{ $sale->total }}</td>
                                        </tr>
                                        @endforeach
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
{{-- Memastikan jQuery dan DataTables JS dimuat --}}
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="{{ asset('js/page/index.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#sales-table').DataTable({
            // Konfigurasi Paging dan Length Menu
            paging: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
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