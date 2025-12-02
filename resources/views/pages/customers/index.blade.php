@extends('layouts.app')

@section('title', 'Data Pelanggan')

@push('style')
{{-- Memastikan DataTables CSS dimuat --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pelanggan</h1>
            <div class="section-header-button">
                {{-- Menggunakan rute yang konsisten: customers.create --}}
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah Pelanggan
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Data Pelanggan</div>
            </div>
        </div>
        
        {{-- Menampilkan Alert dari session --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="section-body">
            <h2 class="section-title">Data Pelanggan</h2>
            <p class="section-lead">
                Kelola data semua pelanggan Anda di halaman ini.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            {{-- Menghilangkan form pencarian manual karena DataTables sudah memiliki fitur pencarian --}}

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                {{-- Pastikan ID tabel adalah 'customers-table' --}}
                                <table class="table table-bordered table-md" id="customers-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone ?? '-' }}</td>
                                            <td>{{ $customer->address ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    {{-- Tautan View --}}
                                                    <a href="{{ route('customers.show', $customer->id) }}"
                                                        class="btn btn-sm btn-info" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    {{-- Tautan Edit --}}
                                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                                        class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    {{-- Form Delete --}}
                                                    <form action="{{ route('customers.destroy', $customer->id) }}"
                                                        method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $customer->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#customers-table').DataTable({
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
            order: [[0, 'asc']],
        });
    });
</script>
@endpush