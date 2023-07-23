<?php

namespace App\Models;
use App\Models\Kerusakan;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table='data_barang';
    //  protected $guarded=['id','kode_barang'];//yang tidak boleh diisi
  
      protected $guarded=['id'];
      
      public function kerusakan(){
        return $this->hasMany(Kerusakan::class,'barang_id,','id');
       }
}
