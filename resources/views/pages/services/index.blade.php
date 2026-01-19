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
                                <table class="table-striped table table-bordered" id="service-table">
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
                                        @foreach ($services as $key => $service)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $service->service_date }}</td>
                                            <td>{{ $service->type }}</td>
                                            <td>{{ $service->vehicle->license_plate }}</td>
                                            <td>{{ $service->vehicle->customer->name }}</td>
                                            <td>{{ $service->technician->name }}</td>
                                            <td>{{ "Rp. " . number_format($service->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-info mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
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

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#service-table').DataTable({
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