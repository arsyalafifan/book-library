@extends('layouts-transaction.app')

{{-- @section('title', 'Pengembalian Buku') --}}

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .container-lg{
        max-width: 600px !important;
    }
    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }
    .purchase-details{
        float:right;
        display: block;
        font-weight: 600;
    }
    .mb-30{
        margin-bottom: 30px;
    }
</style>
@endpush

@section('content')
<div class="container container-lg pt-5" method="post">
    <div class="purchase pt-md-80 pt-80">
        <form action="{{ route('pengembalian-buku.detail.update', $detail->id) }}" method="post">
            @csrf
                <h2 class="fw-bold text-xl mb-30">Detail Peminjaman</h2>
                <p name="kode_peminjaman" class="text-lg mb-30">Kode Peminjaman<span class="purchase-details">{{ $detail->kode_peminjaman }}</span></p>
                <p name="nama_buku" class="text-lg mb-30">Judul Buku<span class="purchase-details">{{ $detail->nama_buku }}</span></p>
                <p class="text-lg mb-30">Nama Anggota<span class="purchase-details">{{ $detail->nama_anggota }}</span></p>
                <p class="text-lg mb-30">Tanggal Peminjaman<span class="purchase-details">{{ $detail->tanggal_pinjam }}</span></p>
                <p class="text-lg mb-30">Lama Peminjaman<span class="purchase-details">{{ $interval }} hari</span></p>
                @php
                    $harga = $interval * 5000;
                    $format_rupiah = "Rp " . number_format($harga,2,',','.');
                @endphp
                <p class="text-lg mb-30">Harga<span class="purchase-details">{{ $format_rupiah}}</span></p>
            <button class="btn btn-primary btn-block" type="submit">Peminjaman Selesai</button>
        </form>
        </p>
        <!-- <p class="text-lg mb-20">Total <span class="purchase-details color-palette-4">Rp 55.000.600</span></p> -->
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush