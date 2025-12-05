@extends('layouts.app')

@section('title', 'Data Teknisi')

@push('style')
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
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
                            {{-- Area Pencarian (biarkan statis untuk saat ini) --}}
                            <div class="float-right">
                                <form action="{{ route('technicians.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            placeholder="Search"
                                            name="search"
                                            value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Teknisi</th>
                                        <th>Keahlian</th>
                                        <th>Status</th>
                                        <th>Terdaftar Sejak</th>
                                        <th>Aksi</th> {{-- Tambah kolom Aksi --}}
                                    </tr>
                                    @foreach ($technicians as $technician)
                                        <tr>
                                            <td>{{ $loop->iteration + ($technicians->currentPage() - 1) * $technicians->perPage() }}</td>
                                            <td>
                                                {{ $technician->name }}
                                                <div class="table-links">
                                                    {{-- <a href="#">View</a> --}}
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('technicians.edit', $technician->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    
                                                    {{-- Tombol Delete --}}
                                                    <form action="{{ route('technicians.destroy', $technician->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-link text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data teknisi ini?')">Trash</button>
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
                                            <td>
                                                <a href="{{ route('technicians.edit', $technician->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $technicians->links() }} {{-- Tampilkan paginasi --}}
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
@endpush