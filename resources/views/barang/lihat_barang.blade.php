<div class="row">
  <div class="col-12">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Nama Pemilik</label>
      <input  class="form-control" disabled value="{{ $b->nama_pemilik }}">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Nama Barang</label>
      <input  class="form-control" disabled value="{{ $b->nama_barang }}">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Tanggal Diterima Barang</label>
      <input  class="form-control" disabled value="{{ $b->tanggal_terima }}">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Serial Number</label>
      <input  class="form-control" disabled value="{{ $b->serial_number }}">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Jumlah</label>
      <input  class="form-control" disabled value="{{ $b->jumlah }}">
    </div>
  </div>
  <div class="col-3">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Satuan</label>
      <input  class="form-control" disabled value="{{ $b->satuan }}">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Kode Barang</label>
      <input  class="form-control" disabled value="{{ $b->kode_barang }}">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label class="text-start mt-2 mb-2 fw-bold" >Lokasi Barang</label>
      <input  class="form-control" disabled value="{{ $b->lokasi_barang }}">
    </div>
  </div>
  <div class="col-12">
    <label class="text-start mt-2 mb-2 fw-bold">Gambar Barang</label>
    <div id="previewContainer">
      @if ($b && $b->image)
        <img class="image-preview w-100" src="{{asset('storage/'.$b->image) }}" alt="Preview">
      @endif
    </div>
  </div>

