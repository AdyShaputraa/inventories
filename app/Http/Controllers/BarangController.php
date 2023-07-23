<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kerusakan;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use GuzzleHttp\Promise\Create;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalBarang =Barang::count();
        $totalKerusakan =Kerusakan::count();

        $barang = Barang::latest();
        if(request('search')){
           $barang->where('nama_barang','like','%'. request('search').'%')
           ->orWhere('serial_number','like','%'. request('search').'%')
           ->orWhere('kode_barang','like','%'. request('search').'%');
        }
        $barang= $barang->paginate(10);
       return view('barang.list_barang',compact(['barang','totalBarang', 'totalKerusakan']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = barang:: all();

    return view ('barang/create_barang', compact(['barang']));
        
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
            'nama_pemilik' =>'required|max:255',
            'nama_barang' =>'required|max:255',
            'serial_number' =>['required','min:3','max:255','unique:data_barang'],
            'kode_barang' =>['required','min:3','max:255','unique:data_barang'],
            'tanggal_terima' =>'required|max:255',
            'jumlah' =>'required|max:255',
            'satuan' =>'required|max:255',
            'lokasi_barang' =>'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'

        ]);
        
        $data= Barang::create($ValidatedData);
        if($request->hasFile('image')){
            $request->file('image')->move('storage/',$request->file('image')->getClientOriginalName());
            $data->image=$request->file('image')->getClientOriginalName();
            $data->save();
        }
        return redirect('/barang')->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        return view('barang.lihat_barang',compact(['barang']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.edit_barang',compact(['barang']));
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
        $validated = $request->validate([
            'nama_pemilik' =>'required|max:255',
            'nama_barang' =>'required|max:255',
            'serial_number' => 'required|min:3|max:25|unique:data_barang,serial_number,'.$id,
            'kode_barang' => 'required|min:3|max:25|unique:data_barang,kode_barang,'.$id,
            'tanggal_terima' =>'required|max:255',
            'jumlah' =>'required|max:255',
            'satuan' =>'required|max:255',
            'lokasi_barang' =>'required|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        
        $barang = Barang::find($id);
        $barang->update($request->except(['_token','submit']));
        if($request->hasfile('image'))
        {
            $destination='storage/'.$barang->image;
            if(Storage::exists($destination)){
                Storage::delete($destination);
            }
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move('storage/',$filename);
            $barang->image=$filename;
        }
        $barang->save();
        
       

        // $barang = Barang::find($id);
        // $barang->update($request->except(['_token','submit']));
        return redirect('/barang')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect('/barang');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportpdf()
    {
      

        $barang = Barang:: all();
        view()->share('Barang', $barang);
        $pdf = Pdf::loadView('barang.exportpdf');
        // return $pdf->download('exportpdf');
        return $pdf->stream();
    }

    public function exportexcel()
    {
        
        $barang = app(Barang::class)->newQuery();

        if ( request()->has('search') && !empty(request()->get('search')) ) {
            $search = request()->query('search');
            $barang->where(function ($query) use($search) {
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
    
        return Excel::download(new BarangExport($barang), 'barang.xlsx');
    }

    public function importexcel(Request $request)
    {
        $request->validate([
            'file'=>'required|mimes:xlsx'
        ]);
        try {
        Excel::import(new BarangImport, $request->file('file'));
        return redirect('/barang')->with('succes','Data Berhasil di Import');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
        return redirect('/barang')->with('import_errors',$failures);
            
        }
    
    }
}
