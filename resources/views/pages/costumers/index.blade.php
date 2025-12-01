@extends('layouts.app')

@section('title', 'Pelanggan')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.bootstrap5.css">


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pelanggan</h1>
            <div class="section-header-button">
                <a href="{{ route('costumers.create') }}"
                    class="btn btn-primary"><i class="fas fa-user-plus"></i> <span>Tambah Pelanggan</span></a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Pelanggan</a></div>
                <div class="breadcrumb-item">Data Pelanggan</div>
            </div>
        </div>
        @include('layouts.alert')
        <div class="section-body">
            <h2 class="section-title">Pelanggan</h2>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table cell-border" id="costumers-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($costumers->count() > 0)
                                        @foreach ($costumers as $key => $costumer )
                                        <tr>
                                            <td> {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $costumer['name'] }}
                                                <div class="table-links">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('costumers.edit', $costumer->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('delete-form-{{$costumer->id}}').submit();"
                                                        class="text-danger">Trash</a>
                                                    <form action="{{route('costumers.destroy', $costumer->id)}}"
                                                        id="delete-form-{{ $costumer->id}}"
                                                        style="display: none;"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $costumer->email }}
                                            </td>
                                            <td>
                                                {{ $costumer->phone }}
                                            </td>
                                            <td>
                                                {{ $costumer->address }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.bootstrap5.js"></script>

<script src="{{ asset('js/page/features-posts.js') }}"></script>

<script>
    new DataTable('#costumers-table', {
        paging: true,
        language: {
            lengthMenu: "Tampilkan _MENU_ entri",
        },
        lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
    });
</script>
@endpush