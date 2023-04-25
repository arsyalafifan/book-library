<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
        $members = Member::get();
        return view('member.member', ['members'=>$members]);
    }

    public function add(){
        return view('member.form-member');
    }

    public function store(Request $request){

        $config = [
            'table' => 'tb_members',
            'length' => 10,
            'prefix' => date('ym'),
        ];
        
        $nomor_anggota = IdGenerator::generate($config);
        $count_nomor_anggota = Member::where('nomor_anggota', $nomor_anggota)->get()->count();
        $last_nomor_anggota = Member::max('nomor_anggota');

        if($count_nomor_anggota >= 1){
            $nomor_anggota = $last_nomor_anggota + 1;
        };

        $request->validate([
            'nomor_anggota' => 'unique',
            'nama' => 'required|unique:tb_members',
            'nim' => 'max:100',
            'tanggal_lahir' => 'max:150',
            'tanggal_bergabung' => 'required',
        ],
        [
            'nama.required' => 'Nama anggota harus diisi',
            'nama.unique' => 'Nama anggota sudah terdaftar',
            'tanggal_bergabung.required' => 'Tanggal bergabung harus diisi',
            
        ]);

        $data = [
            'nomor_anggota' => $nomor_anggota,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_bergabung' => $request->tanggal_bergabung
        ];

        $current_date = Carbon::now();
        $current_date->format('Y-m-d');
        // $current_date->toDateString();
        $validate_tanggal_lahir = $request->tanggal_lahir;
        $validate_tanggal_bergabung = $request->tanggal_bergabung;

        $tanggal_lahir = $current_date <= $validate_tanggal_lahir;
        $tanggal_bergabung = $current_date <= $validate_tanggal_bergabung;

        // echo $current_date->toDateString();
        // echo $validate_tanggal_bergabung;
        // echo $tanggal_bergabung;

        if($tanggal_lahir || $tanggal_bergabung){
            Alert::error(' Invalid Date ', ' Tangal tidak boleh lebih besar dari hari ini');
            return redirect()->route('member.add');
            // echo $tanggal_bergabung;
        }
        Member::create($data);
        Alert::success('Sukses', 'Sukses, Berhasil menambahkan data anggota');
        return redirect()->route('member');
        
    }

    public function edit($id){
        $member = Member::find($id);
        return view('member.form-member', ['member'=>$member]);
    }

    public function update($id, Request $request){
        $request->validate([
            'nama' => 'required',
            'nim' => 'max:100',
            'tanggal_lahir' => 'max:150',
            'tanggal_bergabung' => 'required',
        ],
        [
            'nama.required' => 'Nama anggota harus diisi',
            'tanggal_bergabung.required' => 'Tanggal bergabung harus diisi',
            
        ]);
        Member::find($id)->update($request->all());
        return redirect()->route('member');

    }

    public function delete($id){
        Member::find($id)->delete();
        return redirect()->route('member');
    }
}
