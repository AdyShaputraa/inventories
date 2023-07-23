<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id();     
            $table->string('nama_pemilik');    
            $table->string('nama_barang');
            $table->string('serial_number')->unique();
            $table->string('kode_barang')->unique();   
            $table->dateTime('tanggal_terima');     
            $table->integer('jumlah');     
            $table->string('satuan');     
            $table->string('lokasi_barang');     
            $table->string('image')->default('barang.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_barang');
    }
}
