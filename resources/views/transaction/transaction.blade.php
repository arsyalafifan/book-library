@extends('layouts-transaction.app')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- css untuk select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<!-- cdn bootstrap4 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@endpush

@section('title', 'Peminjaman Buku')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Peminjaman Buku</h6>
    </div>
    <form action="{{ route('transaction.store') }}" method="POST">
         @csrf
        <div class="card-body">

            <div class="form-group">
                <label>Judul Buku</label>
                <select id="nama_buku" name="nama_buku" class="form-control">
                    <option value=""></option>
                    @foreach ($books as $book)
                        <option value="{{ $book->judul_buku }}">{{ $book->judul_buku }} Stok: {{ $book->stok }}</option>
                    @endforeach
                </select>
                @if ($errors->has('nama_buku'))
                    <span class="text-danger text-left">{{ $errors->first('nama_buku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Nama Anggota</label>
                <select id="nama_anggota" name="nama_anggota" class="form-control">
                    <option value=""></option>
                    @foreach ($members as $member)
                        <option value="{{ $member->nama }}">{{ $member->nama }}</option>
                    @endforeach
                </select>
                @if ($errors->has('nama_anggota'))
                    <span class="text-danger text-left">{{ $errors->first('nama_anggota') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Tanggal Pinjam" />
                    {{-- @if ($errors->has('tanggal_terbit'))
                        <span class="text-danger text-left">{{ $errors->first('tanggal_terbit') }}</span>
                    @endif --}}
                </div>
                @if ($errors->has('tanggal_pinjam'))
                    <span class="text-danger text-left">{{ $errors->first('tanggal_pinjam') }}</span>
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
<!-- wajib jquery  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
crossorigin="anonymous">
</script>
<!-- js untuk bootstrap4  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
crossorigin="anonymous"></script>
<!-- js untuk select2  -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $("#nama_buku").select2({
            theme: 'bootstrap4',
            placeholder: "Please Select"
        });

        $("#nama_anggota").select2({
            theme: 'bootstrap4',
            placeholder: "Please Select"
        });
    });
</script>
@endpush