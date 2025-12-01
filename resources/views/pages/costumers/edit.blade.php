@extends('layouts.app')

@section('title', 'Create New Post')

@push('style')
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
                <a href="{{ route('costumers.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Pelanggan</a></div>
                <div class="breadcrumb-item">Edit Pelanggan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Pelanggan</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Pelanggan</h4>
                        </div>
                        <form action="{{ route('costumers.update', $costumers->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Baris Pertama: Nama & Email --}}
                                <div class="row">
                                    {{-- Input Nama --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label text-md-left">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{old('name', $costumers->name)}}">
                                        </div>
                                    </div>

                                    {{-- Input Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label text-md-left">Email</label>
                                            <input type="text" name="email" class="form-control" value="{{old('email', $costumers->email)}}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Baris Kedua: Phone & Address --}}
                                <div class="row">
                                    {{-- Input Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label text-md-left">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{old('phone', $costumers->phone)}}">
                                        </div>
                                    </div>

                                    {{-- Input Address --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label text-md-left">Address</label>
                                            <input type="text" name="address" class="form-control" value="{{old('address', $costumers->address)}} ">
                                        </div>
                                    </div>
                                </div>

                                {{-- Baris Ketiga: Tombol Create Post (paling ujung kanan) --}}
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <div class="form-group mb-0">
                                            <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <span>Simpan</span></button>
                                        </div>
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
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

<script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush