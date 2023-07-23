<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nama_lengkap' => $row['nama_lengkap'],
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
            'email' => $row['email'],
            'no_hp' => $row['no_hp'] ,
        ]);
    }
    
    public function rules(): array
    {
        
        return [
            'nama_lengkap'=> 'required',
            '*.nama_lengkap' => 'required',
            'username'=> 'required|unique:users',
            '*.username'=> 'required|unique:users',
            'password'=> 'required',
            '*.password'=> 'required',
            'email'=> 'required|unique:users',
            '*.email'=> 'required|unique:users',
            'no_hp' => 'required|regex:/(628)[0-9]{10}/',
            '*.no_hp' => 'required|regex:/(628)[0-9]{10}/',
        ];
    }
}
