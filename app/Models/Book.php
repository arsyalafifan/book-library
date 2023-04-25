<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tb_books';

    protected $fillable = [
        'judul_buku',
        'penerbit',
        'nama_pengarang',
        'tanggal_terbit',
        'stok'
    ];
}
