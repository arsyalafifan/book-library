@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('title', 'Form Book')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ isset($book) ? "Edit Book" : "Add Book" }}</h6>
    </div>
    <form action="{{ isset($book) ? route('book.add.update', $book->id) : route('book.add.store') }}" method="POST">
         @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ isset($book) ? $book->judul_buku : '' }}">
                @if ($errors->has('judul_buku'))
                    <span class="text-danger text-left">{{ $errors->first('judul_buku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ isset($book) ? $book->penerbit : '' }}">
                @if ($errors->has('penerbit'))
                    <span class="text-danger text-left">{{ $errors->first('penerbit') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" value="{{ isset($book) ? $book->nama_pengarang : '' }}">
                @if ($errors->has('nama_pengarang'))
                    <span class="text-danger text-left">{{ $errors->first('nama_pengarang') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type="datetime-local" class="form-control" id="tanggal_terbit" name="tanggal_terbit" placeholder="{{ isset($book) ? $book->tanggal_terbit : 'Tanggal Terbit' }}" value="{{ isset($book) ? $book->tanggal_terbit : '' }}" />
                    @if ($errors->has('tanggal_terbit'))
                        <span class="text-danger text-left">{{ $errors->first('tanggal_terbit') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{ isset($book) ? $book->stok : '' }}">
                @if ($errors->has('stok'))
                    <span class="text-danger text-left">{{ $errors->first('stok') }}</span>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </form>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush