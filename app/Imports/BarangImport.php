<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BarangImport implements ToModel,WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'nama_pemilik' => $row['nama_pemilik'],
            'nama_barang' => $row['nama_barang'],
            'serial_number' => $row['serial_number'],
            'kode_barang' => $row['kode_barang'],
            'tanggal_terima' => $row['tanggal'],
            'jumlah' => $row['jumlah'],
            'satuan' => $row['satuan'],
            'lokasi_barang' => $row['lokasi_barang'],
        ]);
    }
    public function rules(): array
    {
        return [
            'nama_pemilik'=> 'required',
            '*.nama_pemilik' => 'required',
            'nama_barang'=> 'required',
            '*.nama_barang' => 'required',
            'serial_number'=> 'required|unique:data_barang',
            '*.serial_number' => 'required|unique:data_barang',
            'kode_barang'=> 'required|unique:data_barang',
            '*.kode_barang' => 'required|unique:data_barang',
            'tanggal'=> 'required',
            '*.tanggal' => 'required',
            'jumlah'=> 'required',
            '*.jumlah' => 'required',
            'satuan'=> 'required',
            '*.satuan' => 'required',
            'lokasi_barang'=> 'required',
            '*.lokasi_barang' => 'required',

        ];
    }
}
