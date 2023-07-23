<div class="container">
  <form action="/user/{{ $u->id }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
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
                <input type="radio" name="status" class="btn-active-edit-user" id="edit-input-active" value="1">
                <label class="btn btn-outline-purple w-100" id="label-edit-input-active" for="edit-input-active">Aktif</label>
              </div>
              <div class="col">
                <input type="radio" name="status" class="btn-active-edit-user" id="edit-input-not-active" value="0">
                <label class="btn btn-outline-purple w-100" id="label-edit-input-not-active" for="edit-input-not-active">Tidak Aktif</label>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.editUser').on('shown.bs.modal', function () {
      if ($('.status_data').val() == 1) {
        $("#edit-input-active").prop("checked", true);
        $('#label-edit-input-active').removeClass("btn-outline-purple");
        $('#label-edit-input-active').addClass("btn-purple");
        $('#label-edit-input-not-active').removeClass("btn-purple");
      } else {
        $("#edit-input-not-active").prop("checked", true);
        $('#label-edit-input-not-active').removeClass("btn-outline-purple");
        $('#label-edit-input-not-active').addClass("btn-purple");
        $('#label-edit-input-active').removeClass("btn-purple");
      }
    });

    $('.btn-active-edit-user').hide();
    $('.btn-active-edit-user').on('change', function() {
      $('#label-edit-input-not-active, #label-edit-input-active').addClass("btn-outline-purple");
      if ($(this).val() == 1) {
        $("#edit-input-active").prop("checked", true);
        $('#label-edit-input-active').removeClass("btn-outline-purple");
        $('#label-edit-input-active').addClass("btn-purple");
        $('#label-edit-input-not-active').removeClass("btn-purple");
      } else {
        $("#edit-input-not-active").prop("checked", true);
        $('#label-edit-input-not-active').removeClass("btn-outline-purple");
        $('#label-edit-input-not-active').addClass("btn-purple");
        $('#label-edit-input-active').removeClass("btn-purple");
      }
    });
  });
</script>