<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalBook = Book::all();
        $totalMember = Member::all();

        return view('dashboard')->with('totalBook', $totalBook)->with('totalMember', $totalMember);
    }
}
