<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UpdatePasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::latest();
        if(request('search')) {
            $user->where('nama_lengkap','like','%'. request('search').'%')->orWhere('username','like','%'. request('search').'%');
        }
        $user = $user->paginate(10);
        return view('user.list_user', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User:: all();
        return view ('user/create_user', compact(['user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @retur n \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidatedData= $request->validate([
            'nama_lengkap' =>'required|max:255',
            'username' =>['required','min:3','max:255','unique:users','alpha_dash'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
            'no_hp' => 'required|regex:/(628)[0-9]{10}/',
            'email' =>'required|unique:users',
            'status'=> 'required|in:1,0'
        ]);
        $ValidatedData['password']=bcrypt($ValidatedData['password']);//encrip password
    //    $ValidatedData['password']=Hash::make($ValidatedData['password']);//sama fungsi encrip
        User::create($ValidatedData);
        // $request->session()->flash('success', 'data sucessfull! Please login');
        return redirect('user')->with('success', 'data sucessfull');//membawa
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit_user',compact(['user']));
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
            'nama_lengkap' =>'required|max:255',
            'username' => 'required|min:3|max:25|unique:users,username,'.$id,
            'no_hp' => 'required|regex:/(628)[0-9]{10}/',
            'email' => 'required|email:dns|min:3|max:25|unique:users,email,'.$id,
            'status'=> 'required|in:1,0',
            
        ]);
        $user = User::find($id);
        $user->status = $request->input('status', $user->status);
        $user->save();
        $user->update($request->except(['_token','submit']));

        return redirect('/user');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
    public function exportpdf()
    {
        $user = User:: all();
        view()->share('User', $user);
        $pdf = Pdf::loadView('user.exportpdf');
        // return $pdf->download('exportpdf');
        return $pdf->stream();
    }
    public function profile()
    {
        $user = User::latest();
        return view('user.profile', compact(['user']));
    }

    public function updateprofile(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' =>'required|max:255',
            'username' => 'required|min:3|max:25|unique:users,username,'.$id,
            'no_hp' => 'required|regex:/(628)[0-9]{10}/',
            'email' => 'required|email:dns|min:3|max:30|unique:users,email,'.$id
           
        ]);
        
        $user = User::find($id);
        $user->update($request->except(['_token','submit']));

        return redirect('/user/profile');
    }

    public function changephoto($id)
    {
        $user = User::findOrFail($id);
        return view('user.changephoto',compact(['user']));
    }

    public function updatephoto(Request $request, $id)
    {
        $validated = $request->validate([
           
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        
        $user = User::find($id);
        $user->update($request->except(['_token','submit']));
        if($request->hasfile('photo'))
        {
            $destination='storage/'.$user->photo;
            if(Storage::exists($destination)){
                Storage::delete($destination);
            }
            $file=$request->file('photo');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move('storage/',$filename);
            $user->photo=$filename;
        }
        $user->save();
        
       

        // $barang = Barang::find($id);
        // $barang->update($request->except(['_token','submit']));
        return redirect('/user');
    }

    public function exportexcel()
    {
        $users = app(User::class)->newQuery();

        if ( request()->has('search') && !empty(request()->get('search')) ) {
            $search = request()->query('search');
            $users->where(function ($query) use($search) {
                $query->where('nama_lengkap', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('no_hp', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
    
        return Excel::download(new UserExport($users), 'user.xlsx');
        // return Excel::download(new UserExport, 'user.xlsx');
    }

    public function importexcel(Request $request)
    {
        $request->validate([
            'file'=>'required|mimes:xlsx'
        ]);
        try {
        Excel::import(new UserImport, $request->file('file'));
        return redirect('/user')->with('succes','Data Berhasil di Import');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect('/user')->with('import_errors',$failures);
        }
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $query = User::query();
        
        if ($status === '0') {
            $query->where('status', 'aktif');
        } elseif ($status === '1') {
            $query->where('status', '!=', 'aktif');
        }
        
        $user = $query->paginate(10);
        
        return view('user.list_user', compact('user'));
        
    
    }
}
