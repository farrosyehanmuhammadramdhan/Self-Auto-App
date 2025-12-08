@extends('layouts.app')

@section('title', 'Data Kendaraan Master')

@push('style')
{{-- CSS Datatables (Client-Side) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Kendaraan</h1>
            <div class="section-header-button">
                <a href="{{ route('vehicle-masters.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kendaraan
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kendaraan</a></div>
                <div class="breadcrumb-item"><a href="#">Master Kendaraan</a></div>
                <div class="breadcrumb-item">Semua Master Kendaraan</div>
            </div>
        </div>

        <div class="section-body">
            {{-- Menampilkan Alert dari session dengan format target --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <h2 class="section-title">Data Master Kendaraan</h2>
            <p class="section-lead">
                Kelola data semua kendaraan master di halaman ini.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Kendaraan Master</h4>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="vehicle-master-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemilik</th>
                                            <th>Merk</th>
                                            <th>Model</th>
                                            <th>Tahun Pembelian</th>
                                            <th>Roda</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Menggunakan $loop->iteration untuk penomoran sederhana yang kompatibel dengan DataTables --}}
                                        @foreach ($vehicle_masters as $key => $vehicle_master)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $vehicle_master->customer->name ?? 'N/A' }}
                                                <div class="table-links">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('vehicle-masters.edit', $vehicle_master->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); 
                                                document.getElementById('delete-form-{{ $vehicle_master->id }}').submit();"
                                                        class="text-danger">Trash</a>
                                                    <form action="#"
                                                        id="delete-form-{{ $vehicle_master->id }}"
                                                        style="display: none;"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{ $vehicle_master->brand }}</td>
                                            <td>{{ $vehicle_master->model }}</td>
                                            <td>{{ $vehicle_master->purchase_year }}</td>
                                            <td>{{ $vehicle_master->wheels }}</td>
                                            <td>{{ $vehicle_master->license_plate }}</td>
                                            <td>{{ $vehicle_master->color ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Menghilangkan div float-right dengan $vehicle_masters->links() untuk mengandalkan DataTables --}}
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
        $('#vehicle-master-table').DataTable({
            // Konfigurasi Paging dan Length Menu
            paging: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],

            // Terjemahan Bahasa Indonesia
            language: {
                lengthMenu: "Tampilkan _MENU_ entri",
                zeroRecords: "Tidak ada data kendaraan yang ditemukan.",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(disaring dari total _MAX_ entri)",
                search: "Cari",

            },
            // Urutan default (opsional)
            order: [
                [0, 'asc']
            ],
            // Menonaktifkan fitur pengurutan pada kolom aksi
            columnDefs: [{
                    orderable: false,
                    targets: 7
                } // Kolom Aksi (indeks 7) tidak dapat diurutkan
            ]
        });

    });
</script>
@endpush