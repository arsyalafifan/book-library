<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $books = Book::get();
        $members = Member::get();
        return view('transaction.transaction', ['books'=>$books], ['members'=>$members]);
    }

    public function store(Request $request){
        $config = [
            'table' => 'tb_library_transactions',
            'length' => 6,
            'prefix' => date('y'),
        ];
        
        $kode_peminjaman = IdGenerator::generate($config);
        
        $count_kode_peminjaman = Transaction::where('kode_peminjaman', $kode_peminjaman)->get()->count();
        $last_kode_peminjaman = Transaction::max('kode_peminjaman');

        if($count_kode_peminjaman >= 1){
            $kode_peminjaman = $last_kode_peminjaman + 1;
        };

        $request->validate([
            'nomor_anggota' => 'unique',
            'nama_buku' => 'required',
            'nama_anggota' => 'required',
            'tanggal_pinjam' => 'required',
        ],
        [
            'nama_buku.required' => 'Nama buku harus diisi',
            'nama_anggota.required' => 'Nama anggota harus diisi',
            'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
            
        ]);

        $data = [
            'kode_peminjaman' => $kode_peminjaman,
            'nama_buku' => $request->nama_buku,
            'nama_anggota' => $request->nama_anggota,
            'tanggal_pinjam' => $request->tanggal_pinjam
        ];

        $current_date = Carbon::now();
        $current_date->format('Y-m-d');

        $compare_date = $current_date <= $request->tanggal_pinjam;
        $stok_buku = Book::where('judul_buku', $request->nama_buku)->value('stok');

        if($compare_date){
            Alert::error(' Invalid Date ', ' Tangal tidak boleh lebih besar dari hari ini');
            return redirect()->route('transaction');
        }
        if($stok_buku < 1){
            Alert::error(' Stok Kosong ', ' Tidak dapat melanjutkan, stok buku tidak tersedia');
            return redirect()->route('transaction');
        }
        
        $store = Transaction::create($data);

        $updateStok = [
            'stok' => $stok_buku - 1
        ];
        if($store){
            Book::where('judul_buku', $request->nama_buku)->update($updateStok);
            Alert::success(' Sukses ', ' Sukses menyimpan data');
            return redirect()->route('transaction');
        }
    }

    // public function updateStok($id, Request $request){
    //     Book::find($id);
    //     $books = Book::get();
    //     $members = Member::get();
    //     $stok_buku = Book::where('judul_buku', $request->nama_buku)->value('stok');
    //     $updateStok = [
    //         'stok' => $stok_buku - 1
    //     ];
    //     Transaction::where('judul_buku', $request->nama_buku)->update($updateStok);
    //     return view('transaction.transaction', ['books'=>$books], ['members'=>$members]);
    // }

}
