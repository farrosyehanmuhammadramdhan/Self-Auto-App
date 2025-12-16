@extends('layouts.app')

@section('title', 'Data Layanan Master')

@push('style')
{{-- Memastikan DataTables CSS dimuat --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Layanan Master</h1>
            <div class="section-header-button">
                <a href="{{ route('services-masters.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Layanan
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Layanan</div>
            </div>
        </div>

        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Layanan</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Layanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="services-master-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($servicemasters as $key => $servicemaster)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $servicemaster->service_name }}
                                            </td>
                                            <td>{{ "Rp. " . number_format($servicemaster->service_price, 0, ',', '.')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
        $('#services-master-table').DataTable({
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