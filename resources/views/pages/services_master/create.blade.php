@extends('layouts.app')

@section('title', 'Tambah Layanan Master')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('services-masters.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Layanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Tambah Layanan Baru</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Buat Layanan Baru</h2>
            <p class="section-lead">
                Isi Form Ini Untuk Menambahkan Data Pelanggan.
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Pelanggan</h4>
                        </div>

                        {{-- PERBAIKAN: Mengganti action ke route yang benar --}}
                        <form action="{{ route('services-masters.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {{-- Kolom Kiri (Nama Layanan) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_name">Nama Layanan <span class="text-danger">*</span></label>
                                            <input type="text" name="service_name" id="service_name"
                                                class="form-control @error('service_name') is-invalid @enderror"
                                                value="{{ old('service_name') }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kolom Kanan (Email) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_price">Harga <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="service_price" id="service_price"
                                                    class="form-control currency" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-icon icon-left btn-primary"> <i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection