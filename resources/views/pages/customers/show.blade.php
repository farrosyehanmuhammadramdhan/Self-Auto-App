@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('customers.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Pelanggan: {{ $customer->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Detail Pelanggan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Informasi Pelanggan</h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Lengkap</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Nama</div>
                                <div class="col-md-9">: {{ $customer->name }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Email</div>
                                <div class="col-md-9">: {{ $customer->email }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">No. HP</div>
                                <div class="col-md-9">: {{ $customer->phone ?? '-' }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Alamat</div>
                                <div class="col-md-9">: {{ $customer->address ?? '-' }}</div>
                            </div>
                            <hr>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection