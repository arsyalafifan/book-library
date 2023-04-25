<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'tb_library_transactions';

    protected $fillable = [
        'kode_peminjaman',
        'nama_buku',
        'nama_anggota',
        'tanggal_pinjam',
        'tanggal_kembali',
        'harga',
        'status',
        'created_at'
    ];
    protected $dates = [
        'tanggal_pinjam',
        'created_at',
    ];
}
