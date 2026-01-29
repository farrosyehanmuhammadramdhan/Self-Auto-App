@extends('layouts.app')

@section('title', 'Tambah Stok Masuk')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                {{-- Menggunakan route yang sudah kita sepakati, misalnya 'customers.index' --}}
                <a href="{{ route('stock.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Tambah Pelanggan Baru</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Buat Data Pelanggan Baru</h2>
            <p class="section-lead">
                Isi Form Ini Untuk Menambahkan Data Pelanggan.
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Pelanggan</h4>
                        </div>
                        <form action="{{ route('stock.storeIn') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Sparepart *</label>
                                        <select name="sparepart_id" class="form-control @error('sparepart_id') is-invalid @enderror">
                                            <option value="">Cari sparepart...</option>
                                            @foreach($spareparts as $item)
                                            <option value="{{ $item->id }}" {{ old('sparepart_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }} (Stok saat ini: {{ $item->stock }})
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('sparepart_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Jumlah *</label>
                                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity', 1) }}" min="1">
                                        @error('quantity')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Keterangan</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                            rows="5" placeholder="Tambahkan keterangan (opsional)">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection