@extends('layouts.app')

@section('title', 'Data Teknisi')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Teknisi</h1>
            <div class="section-header-button">
                <a href="{{ route('technicians.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah Teknisi
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Teknisi</a></div>
                <div class="breadcrumb-item"><a href="#">Data Teknisi</a></div>
                <div class="breadcrumb-item">Daftar Data Teknisi</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Teknisi</h2>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Teknisi</h4>
                        </div>
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table" id="technicians-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Teknisi</th>
                                            <th>Keahlian</th>
                                            <th>Status</th>
                                            <th>Terdaftar Sejak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($technicians as $key => $technician)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $technician->name }}
                                                <div class="table-links">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('technicians.edit', $technician->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $technician->id }}').submit();"
                                                        class="text-danger">Trash</a>
                                                    <form action="{{ route('technicians.destroy', $technician->id) }}"
                                                        id="delete-form-{{ $technician->id }}"
                                                        style="display: none;"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{ $technician->skill }}</td>
                                            <td>
                                                @if ($technician->is_active)
                                                <div class="badge badge-success">Aktif</div>
                                                @else
                                                <div class="badge badge-danger">Tidak Aktif</div>
                                                @endif
                                            </td>
                                            <td>{{ $technician->created_at->format('d/m/Y') }}</td>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#technicians-table').DataTable({
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