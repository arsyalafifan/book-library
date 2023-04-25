<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'tb_members';

    protected $fillable = [
        'nomor_anggota',
        'nama',
        'nim',
        'tanggal_lahir',
        'tanggal_bergabung'
    ];
}
