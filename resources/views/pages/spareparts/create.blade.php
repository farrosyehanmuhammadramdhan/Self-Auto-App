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
<link rel="stylesheet"
    href="{{ asset('library/select2/dist/css/select2.min.css') }}">
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

                            <form action="{{ route('spareparts.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_sparepart">Kode Sparepart <span class="text-danger">*</span></label>
                                            <input type="text" name="code" id="code"
                                                class="form-control" placeholder="Kode Sparepart" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Sparepart <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control" placeholder="Nama Sparepart" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kategori <span class="text-danger">*</span></label>
                                            <select name="category_id"
                                                class="form-control select2 @error('category_id') is-invalid @enderror" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="stok">Stok <span class="text-danger">*</span></label>
                                            <input type="number" name="stock" id="stock"
                                                class="form-control" value="0" min="0" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="price_buy" id="price_buy"
                                                    class="form-control currency" value="0" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script> 
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.selectric').selectric();
        $('.select2').select2();
    });
</script>
@endpush