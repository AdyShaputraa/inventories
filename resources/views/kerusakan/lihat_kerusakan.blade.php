@extends('dashboard.layouts.main')
@section('container')
<div class="container">
  <section>
    <div class="row">
      <div class="text-start mt-4 mb-4 fw-bold">
        Detail Barang
      </div>

        <div class="row">
          <div class="mb-3">
            <label class="text-start mt-2 mb-2 fw-bold" >Nama Barang</label>
          <input  class="form-control" readonly value="{{  $kerusakan->barang->nama_barang }}">
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label class="text-start mt-2 mb-2 fw-bold" >Serial Number</label>
            <input  class="form-control" readonly value="{{  $kerusakan->barang->serial_number }}">
            </div>

            <div class="mb-3">
              <label class="text-start mt-2 mb-2 fw-bold" >Kode Barang</label>
            <input  class="form-control" readonly value="{{  $kerusakan->barang->kode_barang }}">
            </div>

            <div class="mb-3">
              <label class="text-start mt-2 mb-2 fw-bold" >Tanggal Diterima Barang</label>
            <input  class="form-control" readonly value="{{  $kerusakan->tanggal }}">
            </div>
          </div>

          <div class="col-lg-6"> 
          <div class="mb-3">
            <label class="text-start mt-2 mb-2 fw-bold" >Jumlah</label>
          <input  class="form-control" readonly value="{{  $kerusakan->jumlah_rusak }}">
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="text-start mt-2 mb-2 fw-bold" >Satuan</label>
              <input  class="form-control" readonly value="{{  $kerusakan->barang->satuan }}">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label class="text-start mt-2 mb-2 fw-bold" >Kerusakan</label>
              <input  class="form-control" readonly value="{{  $kerusakan->kerusakan_barang }}">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="text-start mt-2 mb-2 fw-bold" >Status</label>
          <input  class="form-control" readonly value="{{  $kerusakan->status }}">
          </div>
        </div>

        
          <div class="col-lg-12">
            <div class="link-button">
              <a style="text-align: center" href="/kerusakan">Batal</a>
            </div>
            </div>

        </div>

    </div>
  </section>
</div>

@endsection
