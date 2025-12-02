@extends('layouts.app')

@section('title', 'Data Spareparts')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Spareparts</h1>
            <div class="section-header-button">
                <a href="{{ route('spareparts.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Spareparts</a></div>
                <div class="breadcrumb-item"><a href="#">Data Spareparts</a></div>
                <div class="breadcrumb-item">Daftar Data Spareparts</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Data Spareparts</h2>
            <p class="section-lead">
                Kelola Data Sparepart
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Spareparts</h4>
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
                                        <th>Nama Spareparts</th>
                                        <th>Kode</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            AHM CHAIN LUBE 70 ML
                                            <div class="table-links">
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#"
                                                    class="text-danger">Trash</a>
                                            </div>
                                        </td>
                                        <td>ACL70ML</td>
                                        <td>General</td>
                                        <td>3</td>
                                        <td>Rp 17.100</td>
                                        <td>Rp 21.000</td>
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