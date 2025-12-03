@extends('layouts.app')

@section('title', 'Tambah Kendaraan Master')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('vehicle-masters.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Master Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kendaraan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('vehicle-masters.index') }}">Kendaraan Master</a></div>
                <div class="breadcrumb-item">Tambah Master Kendaraan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Buat Data Master Kendaraan Baru</h2>
            <p class="section-lead">
                Isi Form Ini Untuk Menambahkan Data Master Kendaraan Baru.
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Master Kendaraan</h4>
                        </div>

                        <form action="{{ route('vehicle-masters.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {{-- KOLOM KIRI: INFORMASI KENDARAAN --}}
                                    <div class="col-md-6">
                                        <h3>Informasi Kendaraan</h3>
                                        <hr>
                                        {{-- 1. Customer (dari Baris Pertama) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Nama Pelanggan<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <select name="customer_id" class="form-control select2 @error('customer_id') is-invalid @enderror" required>
                                                    <option value="">Pilih Pelanggan</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 2. Merk (dari Baris Kedua) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Merk<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="brand" required value="{{ old('brand') }}" class="form-control @error('brand') is-invalid @enderror">
                                                @error('brand')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 3. Model (dari Baris Ketiga) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Model<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="model" required value="{{ old('model') }}" class="form-control @error('model') is-invalid @enderror">
                                                @error('model')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 4. Tipe (dari Baris Keempat) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Tipe Kendaraan<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="type" required value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror">
                                                @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 5. Tahun Model (dari Baris Kelima) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Tahun<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="number" name="model_year" required value="{{ old('model_year') }}" class="form-control @error('model_year') is-invalid @enderror">
                                                @error('model_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 6. Jumlah Roda (dari Baris Keenam) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Jumlah Roda<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control selectric @error('wheels') is-invalid @enderror" required name="wheels">
                                                    <option value="">Pilih Jumlah Roda</option>
                                                    @foreach ($wheelsOptions as $value => $label)
                                                    <option value="{{ $value }}" {{ old('wheels') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('wheels')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 7. Nomor Plat (dari Baris Ketujuh) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Nomor Plat<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="license_plate" required value="{{ old('license_plate') }}" class="form-control @error('license_plate') is-invalid @enderror">
                                                @error('license_plate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 8. Warna Kendaraan (dari Baris Kedelapan) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Warna Kendaraan<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="color" required value="{{ old('color') }}" class="form-control @error('color') is-invalid @enderror">
                                                @error('color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    {{-- KOLOM KANAN: INFORMASI TAMBAHAN --}}
                                    <div class="col-md-6">
                                        <h3>Informasi Tambahan</h3>
                                        <hr>
                                        {{-- 1. Nomor Rangka (VIN) (dari Baris Pertama) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Nomor Rangka (VIN)<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="vin" required value="{{ old('vin') }}" class="form-control @error('vin') is-invalid @enderror">
                                                @error('vin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 2. Nomor Mesin (dari Baris Kedua) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Nomor Mesin<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="engine_number" value="{{ old('engine_number') }}" class="form-control @error('engine_number') is-invalid @enderror">
                                                @error('engine_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 3. Tahun Pembelian (dari Baris Ketiga) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Tahun Pembelian<span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="number" name="purchase_year" required value="{{ old('purchase_year') }}" class="form-control @error('purchase_year') is-invalid @enderror">
                                                @error('purchase_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- 4. Catatan (dari Baris Keempat) --}}
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">Catatan (Opsional)</label>
                                            <div class="col-sm-12 col-md-7">
                                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" style="height: 100px">{{ old('note') }}</textarea>
                                                @error('note')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- Tombol Simpan (Dipindahkan ke ujung kanan) --}}
                                <div class="row">
                                    {{-- Menggunakan d-flex dan justify-content-end untuk memposisikan tombol ke kanan --}}
                                    <div class="col-12 d-flex justify-content-end">
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

@push('scripts')
{{-- Memuat JS Selectric dan Select2 --}}
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>


<script>
    $(document).ready(function() {
        $('.selectric').selectric();
        $('.select2').select2();
    });
</script>
@endpush