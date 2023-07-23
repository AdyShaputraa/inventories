<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerusakanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerusakan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->integer('jumlah_rusak');
            $table->string('kerusakan_barang');
            $table->enum('status', ['Diterima','Service','Selesai','Serahkan'])->default('Diterima');
            $table->string('nama_penerima');
            $table->string('catatan_service')->nullable();
            $table->string('catatan_selesai')->nullable();
            $table->string('catatan_serahkan')->nullable();
            $table->string('nama_penyervice')->nullable();
            $table->string('penerima_barang')->nullable();
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
        Schema::dropIfExists('kerusakan_barangs');
    }
}
