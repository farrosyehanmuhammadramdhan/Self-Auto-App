@extends('layouts.app')

@section('title', 'Data Spareparts')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Spareparts</h1>
            <div class="section-header-button">
                <a href="{{ route('spareparts.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Data Spareparts</a></div>
                <div class="breadcrumb-item">Daftar Data Spareparts</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Spareparts</h2>
            <p class="section-lead">
                Kelola Data Sparepart
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Spareparts</h4>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table" id="spareparts-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Spareparts</th>
                                            <th>Kode</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $spareparts as $key => $sparepart )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $sparepart->name }}
                                                <div class="table-links">
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        class="text-danger">Trash</a>
                                                </div>
                                            </td>
                                            <td>{{ $sparepart->code }}</td>
                                            <td>{{ $sparepart->category->name }}</td>
                                            <td>{{ $sparepart->stock }}</td>
                                            <td>{{ $sparepart->price_buy }}</td>
                                            <td>{{ $sparepart->price_sell }}</td>
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
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#spareparts-table').DataTable({
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