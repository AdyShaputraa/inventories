<div class="col-lg-12">
  <form action="/kerusakan/{{ $k->id }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf

    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Nama Pemilik</label>
          <input type="text" class="form-control" value="{{ $k->barang->nama_pemilik }}" readonly disabled>
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Nama Barang</label>
          <input type="text" class="form-control" value="{{ $k->barang->nama_barang }}" readonly disabled>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Serial Number</label>
          <input type="text" class="form-control" value="{{ $k->barang->serial_number }}" readonly disabled>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Kode Barang</label>
          <input type="text" class="form-control" value="{{ $k->barang->kode_barang }}" readonly disabled>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Jumlah Barang / Qty</label>
          <input type="number" name="jumlah_rusak" class="form-control @error('jumlah_rusak') is-invalid @enderror" id="jumlah_rusak" placeholder="Qty Barang"  required value="{{  $k->jumlah_rusak }}">
          @error('jumlah_rusak')
          <div class="invalid-feedback">
            {{ $message }}
          </div>  
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Satuan</label>
          <input type="text" class="form-control" value="{{ $k->barang->satuan }}" readonly disabled>
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Kerusakan</label>
          <textarea name="kerusakan_barang" id="" rows="4" cols="50" class="form-control @error('kerusakan_barang') is-invalid @enderror" placeholder="Masukan Keterangan disini" id="floatingTextarea" value="{{ old('kerusakan_barang', $k->kerusakan_barang) }}" required>{{ old('kerusakan_barang', $k->kerusakan_barang) }}</textarea>
          @error('kerusakan_barang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Diterima Oleh</label>
          <input type="text" name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror" id="nama_penerima" placeholder="Masukan Nama Pemilik Barang"  required value="{{  $k->nama_penerima }}">
          @error('nama_penerima')
          <div class="invalid-feedback">
            {{ $message }}
          </div>  
          @enderror
        </div>
      </div>
      <div class="col-12 mt-5">
        <div class="row">
          <div class="col-6"><button type="button" class="btn btn-outline-purple w-100" data-bs-dismiss="modal">Batal</button></div>
          <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
        </div>
      </div>
    </div>
  </form>
</div>