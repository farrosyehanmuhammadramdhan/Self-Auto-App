@extends('layouts.app')

@section('title', 'Data Servis')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pelanggan</h1>
            <div class="section-header-button">
                <a href="#"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-user-plus"></i>
                        Tambah
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Services</a></div>
                <div class="breadcrumb-item">All Services</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Services</h2>
            <p class="section-lead">
                You can manage all Services here.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Service</h4>
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
                                        <th>Tanggal</th>
                                        <th>Jenis Servis</th>
                                        <th>Kendaraan</th>
                                        <th>Pelanggan</th>
                                        <th>Teknisi</th>
                                        <th>Total Biaya</th>
                                    </tr>
                                                                        
                                    <tr>
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