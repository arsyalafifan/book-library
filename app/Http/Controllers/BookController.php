<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::get();
        return view('book.book', ['books'=>$books]);
    }

    public function add(){
        return view('book.form-book');
    }

    public function store(Request $request){
        $request->validate([
            'judul_buku' => 'required|unique:tb_books',
            'penerbit' => 'max:100',
            'nama_pengarang' => 'max:150',
            'stok' => 'required',
        ],
        [
            'judul_buku.required' => 'Judul buku harus diisi',
            'judul_buku.unique' => 'Judul buku sudah pernah diinput',
            'stok.required' => 'Stok buku harus diisi',
            
        ]);

        $current_date = Carbon::now();
        $current_date->format('Y-m-d');
        $validate_tanggal_terbit = $request->tanggal_terbit;
        $compare_date = $current_date <= $validate_tanggal_terbit;

        if($compare_date){
            Alert::error(' Invalid Date ', ' Tangal terbit tidak boleh lebih besar dari hari ini');
            return redirect()->route('book.add');
        }

        $input = $request->all();

        Book::create($input);
        return back()->with('success','Berhasil menginput buku!');
    }

    public function edit($id){
        $book = Book::find($id);
        return view('book.form-book', ['book'=>$book]);
    }

    public function update($id, Request $request){
        $request->validate([
            'judul_buku' => 'required',
            'penerbit' => 'max:100',
            'nama_pengarang' => 'max:150',
            'stok' => 'required',
        ],
        [
            'judul_buku.required' => 'Judul buku harus diisi',
            'judul_buku.unique' => 'Judul buku sudah pernah diinput',
            'stok.required' => 'Stok buku harus diisi',
            
        ]);

        $current_date = Carbon::now();
        $current_date->format('Y-m-d');
        $validate_tanggal_terbit = $request->tanggal_terbit;
        $compare_date = $current_date <= $validate_tanggal_terbit;

        if($compare_date){
            Alert::error(' Invalid Date ', ' Tangal terbit tidak boleh lebih besar dari hari ini');
            return back();
        }

        Book::find($id)->update($request->all());
        return redirect()->route('book');
    }

    public function delete($id){
        Book::find($id)->delete();
        return redirect()->route('book');
    }
}
