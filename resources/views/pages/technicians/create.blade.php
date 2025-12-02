@extends('layouts.app')

@section('title', 'Tambah Teknisi')

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
                    <a href="{{ route('technicians.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah Teknisi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Teknisi</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Teknisi</a></div>
                    <div class="breadcrumb-item"><a href="#">Daftar Data Teknisi</a></div>
                    <div class="breadcrumb-item">Tambah Teknisi</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tambah Teknisi</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Tambah Teknisi</h4>
                            </div>
                            <form action="{{ route('technicians.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Teknisi</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" id="name" required=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keahlian</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea
                                            class="form-control"
                                            name="skill"
                                            data-height="150"
                                            required="">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="status" class="form-control selectric">
                                            <option value="1" {{ $technician->status == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ $technician->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
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
