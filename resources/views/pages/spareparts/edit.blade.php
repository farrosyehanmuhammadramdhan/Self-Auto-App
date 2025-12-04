@extends('layouts.app')

@section('title', 'Tambah Spareparts')

@push('style')
<link rel="stylesheet"
    href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('spareparts.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Sparepart</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Data Spareparts</a></div>
                <div class="breadcrumb-item">Tambah Sparepart Baru</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title">Tambah Sparepart</h2>
                            <p class="section-lead">Tambah data sparepart baru</p>

                            <form action="{{ route('spareparts.update', $sparepart) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Kode Sparepart <span class="text-danger">*</span></label>
                                            <input type="text" name="code" id="code"
                                                class="form-control" placeholder="Kode Sparepart" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Nama Sparepart <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control" placeholder="Nama Sparepart" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id">Kategori <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control selectric" required>
                                                <option value="" selected>Pilih Kategori</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price_buy">Harga Beli <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="price_buy" id="price_buy"
                                                    class="form-control currency" value="0" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price_sell">Harga Jual <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="price_sell" id="price_sell"
                                                    class="form-control currency" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-icon icon-left btn-primary">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

<script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush