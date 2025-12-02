@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                {{-- Menggunakan route yang sudah kita sepakati, misalnya 'customers.index' --}}
                <a href="{{ route('customers.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
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
                        
                        {{-- PERBAIKAN: Mengganti action ke route yang benar --}}
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                {{-- ============================================= --}}
                                {{-- BARIS PERTAMA: Nama dan Email (Dua Kolom)     --}}
                                {{-- ============================================= --}}
                                <div class="row">
                                    {{-- Kolom Kiri (Nama) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name') }}" required>
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
                                            <label for="email">Email</label>
                                            <input type="email" name="email" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- ================================================= --}}
                                {{-- BARIS KEDUA: No. HP dan Alamat (Dua Kolom)        --}}
                                {{-- ================================================= --}}
                                <div class="row">
                                    {{-- Kolom Kiri (No. HP) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">No. HP</label>
                                            <input type="text" name="phone" 
                                                class="form-control @error('phone') is-invalid @enderror" 
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kolom Kanan (Alamat) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            {{-- Menggunakan textarea untuk Alamat --}}
                                            <textarea class="form-control @error('address') is-invalid @enderror"
                                                name="address"
                                                data-height="150">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- ============================================= --}}
                                {{-- BARIS AKSI: Tombol Simpan (Satu Baris Penuh)  --}}
                                {{-- ============================================= --}}
                                <div class="form-group row mb-4">
                                    <div class="col-12 text-right"> 
                                        {{-- Gunakan col-12 dan text-right agar tombol di kanan --}}
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