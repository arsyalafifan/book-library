@extends('layouts.app')

@section('title', 'Manage Book')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('book.add') }}" class="btn btn-primary mb-2">Add Book</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Buku</th>
                        <th>Judul Buku</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Tanggal Terbit</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($number = 1)
                    @foreach ($books as $item)
                        <tr>
                            <td>
                                {{ $number++ }}
                            </td>
                            <td>
                                {{ $item->id}}
                            </td>
                            <td>
                                {{ $item->judul_buku}}
                            </td>
                            <td>
                                {{ $item->penerbit}}
                            </td>
                            <td>
                                {{ $item->nama_pengarang}}
                            </td>
                            <td>
                                {{ $item->tanggal_terbit}}
                            </td>
                            <td>
                                {{ $item->stok}}
                            </td>
                            <td>
                                <a href="{{ route('book.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('book.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection