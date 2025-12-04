@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

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
                <a href="{{ route('categories.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kategori</a></div>
                <div class="breadcrumb-item">Tambah Kategori</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Kategori</h2>
            <p class="section-lead">
                Tambah Data Kategori Baru
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Kategori Spareparts</h4>
                        </div>
                        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Nama -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kategori</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                            class="form-control">
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