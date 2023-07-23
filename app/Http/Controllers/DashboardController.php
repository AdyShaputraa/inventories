<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalBarang = Barang::count();
        $totalKerusakan = Kerusakan::count();
        $totalAllUser = User::count();
        $totalUser = User::where('role','0')->count();
        $totalAdmin = User::where('role','1')->count();

        return view('dashboard.index',compact('totalBarang', 'totalKerusakan', 'totalAllUser','totalUser','totalAdmin'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        
        $barang = Barang::where('nama_barang', 'LIKE', "%$keyword%")->pluck('nama_barang');
        $kerusakan = Kerusakan::where('keterangan', 'LIKE', "%$keyword%")->pluck('keterangan');
        $users = User::where('name', 'LIKE', "%$keyword%")->pluck('name');

        $results = [
            'barang' => $barang,
            'kerusakan' => $kerusakan,
            'users' => $users
        ];

        return response()->json($results);
    }
}

