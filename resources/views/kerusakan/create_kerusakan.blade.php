@extends('layouts.main')
@section('content')
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="card bg-flat-color-1">
        <div class="card-body">
        <div class="text-start mt-4 mb-4 fw-bold">
          <span class="fw-bold text-muted mr-4">Buat Data Kerusakan Barang</span>
        </div>
          <form action="/kerusakan/create">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari Nama Barang" name="search" value="{{ request('search') }}" />
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </form>
          <br>
          <form action="/kerusakan" method="POST">
            @csrf
            <div class="form-group">
              <input type="hidden" name="barang_id" class="form-control" value="{{ $searchBarang ? $searchBarang->id:'' }}"/>
            </div>
            <div class="form-group">
              <label>Nama Pemilik</label>
              <input class="form-control" value="{{ $searchBarang ? $searchBarang->nama_pemilik:'' }}" readonly />
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input class="form-control" value="{{ $searchBarang ? $searchBarang->nama_barang:'' }}" readonly />
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Serial Number</label>
                  <input class="form-control" value="{{ $searchBarang ? $searchBarang->serial_number:'' }}" readonly />
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Kode Barang</label>
                  <input class="form-control" value="{{ $searchBarang ? $searchBarang->kode_barang:'' }}" readonly />
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Jumlah Barang / Qty</label><small class="text-danger"> *</small>
                  <input type="number" name="jumlah_rusak" class="form-control @error('jumlah_rusak') is-invalid @enderror" value="{{ old('jumlah_rusak') }}" required/>
                  @error('jumlah_rusak')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Satuan</label><small class="text-danger"> *</small>
                  <input class="form-control" value="{{ $searchBarang ? $searchBarang->satuan:'' }}" readonly >
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Kerusakan</label>
              <textarea name="kerusakan_barang" rows="4" cols="50" class="form-control @error('kerusakan_barang') is-invalid @enderror" placeholder="Masukan Keterangan disini" id="floatingTextarea" value="{{ old('kerusakan_barang') }}" required></textarea>
              @error('kerusakan_barang')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Diterima Oleh</label>
              <input type="text" name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror" placeholder="Masukan Nama Penerima Barang" required value="{{ old('nama_penerima') }}">
              @error('nama_penerima')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12 mt-3">
              <div class="row">
                <div class="col-6">
                  <a href="/kerusakan">
                    <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                  </a>
                </div>
                <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection