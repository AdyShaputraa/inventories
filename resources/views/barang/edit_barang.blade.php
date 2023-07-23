<div class="container">
  <form action="/barang/{{ $b->id }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Nama Pemilik</label>
          <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" id="nama_pemilik" placeholder="Masukan Nama Pemilik"  required value="{{  $b->nama_pemilik }}">
          @error('nama_pemilik')
          <div class="invalid-feedback">
            {{ $message }}
          </div>  
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Masukan Nama Barang"  required value="{{  $b->nama_barang }}">
          @error('nama_barang')
            <div class="invalid-feedback">
              {{ $message }}
            </div>  
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Tanggal Diterima Barang</label>
          <input type="datetime-local" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" id="tanggal_terima" placeholder="Pilih Tanggal Terimma Barang"  required value="{{  $b->tanggal_terima }}">
          @error('tanggal_terima')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Serial Number</label>
          <input type="text" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" placeholder="Masukan Serial Number Barang"  required value="{{  $b->serial_number }}">
          @error('serial_number')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Jumlah</label>
          <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" placeholder="Qty Barang"  required value="{{  $b->jumlah }}">
          @error('jumlah')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Satuan</label>
          <select name="satuan" class="form-control @error('satuan') is-invalid @enderror" aria-label=".form-select-sm example" required value="{{ old('satuan') }}">
            <option selected disabled value>Cari Satuan</option>
            <option {{old('satuan',$b->satuan)=="Pcs"? 'selected':''}}  value="Pcs">Pcs</option>
            <option {{old('satuan',$b->satuan)=="Unit"? 'selected':''}} value="Unit">Unit</option>                       
            <option {{old('satuan',$b->satuan)=="Dus"? 'selected':''}} value="Dus">Dus</option>     
          </select>
          @error('satuan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Kode Barang</label>
          <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" placeholder="Masukan Kode Barang"  required value="{{  $b->kode_barang }}">
          @error('kode_barang')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="text-start mt-2 mb-2 fw-bold" >Lokasi Barang</label>
          <input type="text" name="lokasi_barang" class="form-control @error('lokasi_barang') is-invalid @enderror" id="lokasi_barang" placeholder="Masukan Lokasi Barang"  required value="{{  $b->lokasi_barang }}">
            @error('lokasi_barang')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-12">
        <label class="text-start mt-2 mb-2 fw-bold">Gambar Barang</label>
        <div class="row">
          <div style="margin: auto; width: 100%; text-align: center;">
            <div style="background-color: #f5e1f7; border-radius: 10px; border: 3px dashed rgba(226, 10, 247, 0.65);">
              <div style="background-color: rgb(245, 225, 247); border-radius: 10px; padding: 10px;">
                <div class="drag-file">
                  <img class="navbar-brand" src="/images/frame.png" alt="Logo"><br>
                  <input type="file" name="image" class="form-control-file" id="image1" accept="image/*" value="{{ old('image') }}" style="visibility: hidden"><br>
                  <label class="drag-file-text" for="image1" id="fileNameLabel"><b>Drag File Gambar Disini</b> <br> atau klik area ini dan pilih File Gambar</label><br><br>
                </div>
                <div id="previewContainer">
                  @if ($b && $b->image)
                  <img class="image-preview" src="{{asset('storage/'.$b->image) }}" alt="Preview">
                  @endif
                </div>
                @if ($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
              </div>
            </div>
          </div>
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
<script>
  document.getElementById('image1').addEventListener('change', function (event) {
    var fileName = event.target.files[0].name;
    document.getElementById('fileNameLabel').textContent = fileName;

    var previewContainer = document.getElementById('previewContainer');
    var previewImage = previewContainer.querySelector('.image-preview');

    if (previewImage) {
      previewContainer.removeChild(previewImage);
    }

    var fileReader = new FileReader();
    fileReader.onload = function (e) {
      var img = document.createElement('img');
      img.setAttribute('src', e.target.result);
      img.setAttribute('class', 'image-preview');
      previewContainer.appendChild(img);
    };
    fileReader.readAsDataURL(event.target.files[0]);
  });
</script>