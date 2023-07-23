<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Kerusakan extends Model
{
    use HasFactory, LogsActivity;
    protected $table='kerusakan_barangs';
    //  protected $guarded=['id','kode_barang'];//yang tidak boleh diisi
  
      // protected $fillable= ['barang_id','jumlah_rusak','kerusakan_barang','status','nama_penerima','catatan','nama_penyervice'];
      protected $guarded=['id'];

      public function barang(){
        return $this->belongsTo(Barang::class);
      }
      public function user(){
        return $this->belongsTo(User::class);
      }
      
  
      protected static $logName = 'kerusakan';
      protected static $logUnguarded = true;
    protected $appends = [
        'status',
        'nama_penerima',
        'catatan_service',
        'catatan_selesai',
        'catatan_serahkan'
    ];
}
