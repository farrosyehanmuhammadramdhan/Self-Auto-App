@extends('layouts.app')

@section('title', 'Data Kategori')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Spareparts</h1>
            <div class="section-header-button">
                <a href="{{ route('categories.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Kategori</a></div>
                <div class="breadcrumb-item">Daftar Kategori</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Kategori Spareparts</h2>
            <p class="section-lead">
                Kelola Data Kategori Sparepart
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Kategori</h4>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="categories-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Dibuat Pada</th>
                                            <th>Diperbarui Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $category->name }}
                                                <div class="table-links">
                                                    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); 
                                                document.getElementById('delete-form-{{ $category->id }}').submit();"
                                                        class="text-danger">Trash</a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        id="delete-form-{{ $category->id }}"
                                                        style="display: none;"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>{{ $category->updated_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    {{ $categories->links() }}
                                </nav>
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
        $('#categories-table').DataTable({
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