<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianBukuController extends Controller
{
    public function index(){
        $data_loans = Transaction::where('status', 'Dalam peminjaman/belum kembali')->get();
        return view('transaction.transaction-pengembalian', ['data_loans'=>$data_loans]);
    }

    public function detail($id){
        $detail = Transaction::find($id);
        $current_date = Carbon::now();
        $current_date->format('Y-m-d');
        $tanggal_pinjam = Transaction::select('tanggal_pinjam')->where('id', $id)->first();
        $tanggal_peminjaman = $tanggal_pinjam->tanggal_pinjam;

        $interval = $current_date->diffInDays($tanggal_peminjaman);
        return view('transaction.transaction-detail', ['detail'=>$detail])->with('interval', $interval);
    }

    public function update($id, Request $request){
        $current_date = Carbon::now();
        $current_date->format('Y-m-d');
        $tanggal_pinjam = Transaction::select('tanggal_pinjam')->where('id', $id)->first();
        $tanggal_peminjaman = $tanggal_pinjam->tanggal_pinjam;
        $interval = $current_date->diffInDays($tanggal_peminjaman);
        $data = [
            'tanggal_kembali' => $current_date,
            'harga' => $interval * 5000,
            'status'=> "Sudah Kembali"
        ];
        $updateTransaction = Transaction::find($id)->update($data);
        $nama_buku = Transaction::select('nama_buku')->where('id', $id)->value('nama_buku');
        $stok_buku = Book::where('judul_buku', $nama_buku)->value('stok');
        $updateStok = [
            'stok' => $stok_buku + 1
        ];
        if($updateTransaction){
            Book::where('judul_buku', $nama_buku)->update($updateStok);
            Alert::success('Sukses', 'Transaksi berhasil, stok sudah kembali ke database');
            return redirect()->route('pengembalian-buku');
        }

    }

    public function delete($id){
        Transaction::find($id)->delete();
        return redirect()->route('pengembalian-buku');
    }
}
