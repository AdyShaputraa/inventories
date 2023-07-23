<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kerusakan;
use App\Models\Activity;
use Illuminate\Http\Reqcade\Pdf;
use Illuminate\Http\Request;
use App\Exports\Kerusuest;
use Barryvdh\DomPDF\FaakanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class KerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalBarang = Barang::count();
        $totalKerusakan = Kerusakan::count();
        $totalService = Kerusakan::where('status', 'Service')->count();
        $totalSelesai = Kerusakan::where('status', 'Selesai')->count();

    
        $activities = Activity::all(); 
        $barang = Barang::all();
        $kerusakan = Kerusakan::latest();
        $activities = Activity::orderBy('created_at', 'desc')->get();
        $searchBarang = null;

        $keyword = $request->input('search');

        $kerusakan = Kerusakan::with('barang')
            ->whereHas('barang', function ($query) use ($keyword) {
                $query->where('nama_barang', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('kerusakan.list_kerusakan', compact('totalSelesai','totalService','barang','searchBarang','activities','kerusakan', 'totalBarang', 'totalKerusakan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kerusakan = kerusakan:: all();
        $barang = Barang:: all();
        $searchBarang = null;
        if(request('search')){
            $searchBarang = $barang->where('nama_barang', request('search'))->first();
        }
        return view ('kerusakan.create_kerusakan', compact(['kerusakan', 'barang', 'searchBarang']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidatedData= $request->validate([
            'barang_id' => 'required',
            'jumlah_rusak' => 'required|integer',
            'kerusakan_barang' => 'required',
            'nama_penerima' => 'required',
        ]);
        
        $kerusakan = new Kerusakan();
        
        $kerusakan->barang_id = $request->input('barang_id');
        $kerusakan->jumlah_rusak = $request->input('jumlah_rusak');
        $kerusakan->kerusakan_barang = $request->input('kerusakan_barang');
        $kerusakan->status = 'Diterima';
        $kerusakan->nama_penerima = $request->input('nama_penerima');
        $kerusakan->catatan_Service = $request->input('catatan_service');
        $kerusakan->catatan_selesai = $request->input('catatan_selesai');
        $kerusakan->catatan_serahkan = $request->input('catatan_serahkan');
        $kerusakan->nama_penyervice = $request->input('nama_penyervice');
        $kerusakan->penerima_barang = $request->input('penerima_barang');
        $kerusakan->save();
    
        return redirect('/kerusakan')->with('success', 'Data Berhasil Ditambah');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kerusakan = Kerusakan::find($id);

        return view('kerusakan.lihat_kerusakan',compact(['kerusakan']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kerusakan = Kerusakan::find($id);
        return view('kerusakan.edit_kerusakan',compact(['kerusakan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kerusakan = Kerusakan::find($id);
        //    dd($request->all());
        $kerusakan->update($request->except(['_token','submit']));
        return redirect('/kerusakan')->with('success', 'Data Berhasil Diupdate');
        
        // 'status' => 'required|in:diterima,diservice,selesai,dikembalikan',
        // $request->validate([
        //     'jumlah_rusak' => 'required|integer',
        //     'kerusakan_barang' => 'required|string',
        //     'nama_penerima' => 'required|string',
        // ]);
        
        // $kerusakan = Kerusakan::findOrFail($id);
        
        // // Update data barang dengan inputan pengguna
        // $kerusakan->jumlah_rusak = $request->input('jumlah_rusak');
        // $kerusakan->kerusakan_barang = $request->input('kerusakan_barang');
        // $kerusakan->nama_penerima = $request->input('nama_penerima');
        // $kerusakan->update($request->except('_token', 'submit'));
        // $kerusakan->save();
        
        // return redirect('/kerusakan')->with('success', 'Data Berhasil Diupdate');
        
    }


    public function showActivityLog(Kerusakan $kerusakan , Barang $id)
    {
        
        $activities = Activity::where('subject_type', Kerusakan::class)
            ->where('subject_id', $kerusakan->id)
            ->orderBy('created_at', 'desc')
            ->get();

            $dataBarang = [];
        
        foreach ($activities as $a) {
            $barangId = json_decode($a->properties)->attributes->barang_id;
            $barang = Barang::find($barangId);

            if ($barang) {
                $dataBarang[] = $barang;
            }
        }

        // Mengambil ID activity terakhir
        $lastActivity = $activities->first();
        $activityId = $lastActivity ? $lastActivity->id : null;
        
        return view('kerusakan.list_kerusakan', compact('barang','kerusakan', 'activities','activityId'));
    }


    public function edit_transaksi($id)
    {
        $kerusakan = Kerusakan::find($id);
        return view('kerusakan.edit_modal', compact('kerusakan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transaksi(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required|in:Diterima,Service,Selesai,Serahkan',
        'nama_penerima' => 'required|string',
        'catatan_service' => 'required|nullable|string',
        'catatan_selesai' => 'required|nullable|string',
        'catatan_serahkan' => 'required|nullable|string',
        'nama_penyervice' => 'required|nullable|string',
        'penerima_barang' => 'required|nullable|string'
        ]);
        
        $kerusakan = Kerusakan::findOrFail($id);
        
        // Update data barang dengan inputan pengguna
        $kerusakan->status = $request->input('status');
        $kerusakan->nama_penerima = $request->input('nama_penerima');
        $kerusakan->catatan_service = $request->input('catatan_service');
        $kerusakan->catatan_selesai = $request->input('catatan_selesai');
        $kerusakan->catatan_serahkan = $request->input('catatan_Serahkan');
        $kerusakan->penerima_barang = $request->input('penerima_barang');
        $kerusakan->update($request->except('_token', 'submit'));
        $kerusakan->save();
        
        return redirect('/kerusakan')->with('success', 'Data Berhasil Diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kerusakan = Kerusakan::find($id);
        $kerusakan->delete();
        return redirect('/kerusakan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportpdf()
    {
        $kerusakan = Kerusakan:: all();
        view()->share('Kerusakan', $kerusakan);
        $pdf = Pdf::loadView('kerusakan.exportpdf');
        // return $pdf->download('exportpdf');
        return $pdf->stream();
    }
    
    public function exportexcel()
    {
        
        $kerusakan = app(Kerusakan::class)->newQuery();
        if ( request()->has('search') && !empty(request()->get('search')) ) {
            $search = request()->query('search');
            $kerusakan->where(function ($query) use($search) {
                $query->where('nama_pemilik', 'LIKE', "%{$search}%")
                    ->orWhere('nama_barang', 'LIKE', "%{$search}%")
                    ->orWhere('serial_number', 'LIKE', "%{$search}%")
                    ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                    ->orWhere('tanggal_terima', 'LIKE', "%{$search}%")
                    ->orWhere('jumlah', 'LIKE', "%{$search}%")
                    ->orWhere('satuan', 'LIKE', "%{$search}%")
                    ->orWhere('lokasi_barang', 'LIKE', "%{$search}%");
            });
        }
    
        return Excel::download(new KerusakanExport($kerusakan), 'kerusakan.xlsx');
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');
        $barang = Barang::all(); // Ambil data barang yang diperlukan
        $totalService = Kerusakan::where('status', 'Service')->count();
        $totalSelesai = Kerusakan::where('status', 'Selesai')->count();

        $query = Kerusakan::query();
        
        if ($status === 'Diterima') {
            $query->where('status', 'Diterima');
        } elseif ($status === 'Service') {
            $query->where('status', 'Service');
        } elseif ($status === 'Selesai') {
            $query->where('status', 'Selesai');
        } elseif ($status === 'Selesai') {
            $query->where('status', 'Selesai');
        } elseif ($status === 'Serahkan') {
            $query->where('status', 'Serahkan');
        }
        
        $kerusakan = $query->paginate(10);
        $activities = Activity::orderBy('created_at', 'desc')->get();
        return view('kerusakan.list_kerusakan', compact('totalSelesai','totalService','activities','kerusakan','barang'));
    }
}
