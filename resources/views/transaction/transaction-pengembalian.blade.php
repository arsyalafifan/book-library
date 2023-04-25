@extends('layouts-transaction.app')

@section('title', 'Pengembalian Buku')

@push('style')
{{-- <link href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
         rel="stylesheet"> --}}
@endpush

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        {{-- <a href="{{ route('member.add') }}" class="btn btn-primary mb-2">Add Member</a> --}}
        <div class="table-responsive">
            <table id="mytableID" style="width:100%" class="table table-striped sampleTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Peminjaman</th>
                        <th>Judul Buku</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($number = 1)
                    @foreach ($data_loans as $item)
                        <tr>
                            <td>
                                {{ $number++ }}
                            </td>
                            <td>
                                <p value="{{ $item->kode_peminjaman}}" name="kode_peminjaman">{{ $item->kode_peminjaman}}</p>
                            </td>
                            <td>
                                {{ $item->nama_buku}}
                            </td>
                            <td>
                                {{ $item->nama_anggota}}
                            </td>
                            <td>
                                {{ $item->tanggal_pinjam}}
                            </td>
                            <td>
                                {{ $item->status}}
                            </td>
                            <td>
                                <a href="{{ route('pengembalian-buku.detail', $item->id) }}" class="btn btn-warning">Detail Peminjaman</a>
                                {{-- <a href="{{ route('pengembalian-buku.delete', $item->id) }}" class="btn btn-danger">Delete</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- 
<script  src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        </script>
        <script src=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
        <script src="fancyTable.js">
        </script>
        <script type="text/javascript">
             
            $(document).ready(function() {
                $(".sampleTable").fancyTable({
                  /* Column number for initial sorting*/
                   sortColumn:0,
                   /* Setting pagination or enabling */
                   pagination: true,
                   /* Rows per page kept for display */
                   perPage:3,
                   globalSearch:true
                   });
                             
            });
        </script> --}}

@endpush