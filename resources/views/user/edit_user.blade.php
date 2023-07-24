<div class="container">
  <form action="/user/{{ $u->id }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
      <input type="hidden" name="id" class="id{{ $u->id }}" value="{{ $u->id }}">
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Example: Ardian Agustin" required value="{{ $u->nama_lengkap }}">
        @error('nama_lengkap')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Example: ardiangistin" required value="{{ $u->username }}">
        @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >No WhatsApp</label>
        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Contoh : 0812345667890" required value="{{ $u->no_hp }}">
        @error('no_hp')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Email </label>(Optional)
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Example: ardiangistin" required value="{{ $u->email }}">
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold">Status Aktif</label><small class="text-danger"> *</small>
        <div class="alert" role="alert">
          <div class="container">
            <div class="row input-group">
              <input type="hidden" class="status_data" value="{{ $u->status; }}">
              <div class="col">
                <input type="radio" name="status" class="btn-active-edit-user" id="edit-input-active{{ $u->id }}" data-id="{{ $u->id }}" value="1" {{ $u->status == 1 ? 'checked' : '' }}>
                <label class="btn {{ $u->status == 1 ? 'btn-purple' : 'btn-outline-purple' }} w-100" id="label-edit-input-active{{ $u->id }}" for="edit-input-active{{ $u->id }}">Aktif</label>
              </div>
              <div class="col">
                <input type="radio" name="status" class="btn-active-edit-user" id="edit-input-not-active{{ $u->id }}" data-id="{{ $u->id }}" value="0" {{ $u->status == 0 ? 'checked' : '' }}>
                <label class="btn {{ $u->status == 0 ? 'btn-purple' : 'btn-outline-purple' }} w-100" id="label-edit-input-not-active{{ $u->id }}" for="edit-input-not-active{{ $u->id }}">Tidak Aktif</label>
              </div>
            </div>
            @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-12 mt-3">
        <div class="row">
          <div class="col-6"><button type="button" class="btn btn-outline-purple w-100" data-bs-dismiss="modal">Batal</button></div>
          <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
        </div>
      </div>
    </div>
  </form>
</div>