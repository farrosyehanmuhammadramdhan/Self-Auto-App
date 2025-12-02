@extends('layouts.app')

@section('title', 'Data Teknisi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Teknisi</h1>
            <div class="section-header-button">
                <a href="{{ route('technicians.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah Teknisi
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Teknisi</a></div>
                <div class="breadcrumb-item"><a href="#">Data Teknisi</a></div>
                <div class="breadcrumb-item">Daftar Data Teknisi</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Teknisi</h2>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Teknisi</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Teknisi</th>
                                        <th>Keahlian</th>
                                        <th>Status</th>
                                        <th>Terdaftar Sejak</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            Agung
                                            <div class="table-links">
                                                <a href="#">View</a>
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#"
                                                    class="text-danger">Trash</a>
                                            </div>
                                        </td>
                                        <td>Mekanik</td>
                                        <td>Tidak Aktif</td>
                                        <td>01/08/2021</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link"
                                                href="#"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link"
                                                href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="#"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush