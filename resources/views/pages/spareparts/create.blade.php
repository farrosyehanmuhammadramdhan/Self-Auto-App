@extends('layouts.app')

@section('title', 'Tambah Spareparts')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('spareparts.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Spareparts</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Data Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Daftar Data Spareparts</a></div>
                <div class="breadcrumb-item">Tambah Spareparts Baru</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Buat Data Spareparts Baru</h2>
            <p class="section-lead">
                Tambah Data Spareparts Baru.
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Spareparts</h4>
                        </div>
                        <form action="">
                            <div class="card-body">
                            <!-- Nama -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Kode -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Spareparts</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name=""
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Spareparts</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="" class="form-control selectric">
                                        <option>Pilih Jenis Spareparts</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Stok -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stok</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="number"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Harga Beli -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-sm-12 col-md-3 col-lg-3">Harga Beli</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control currency">
                                    </div>
                                </div>
                            </div>

                            <!-- Harga Jual -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-sm-12 col-md-3 col-lg-3">Harga Jual</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control currency">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-icon icon-left btn-primary"> <i class="fa-solid fa-floppy-disk"></i> Simpan</button>
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
<!-- JS Libraies -->
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush