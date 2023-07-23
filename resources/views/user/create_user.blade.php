<div class="container">
  <form action="/user" method="POST">
    @csrf
    <div class="row">
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Example: Ardian Agustin" required value="{{ old('nama_lengkap') }}">
        @error('nama_lengkap')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Username</label>
        <input type="email" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Example: ardiangistin" required value="{{ old('username') }}">
        @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password disini" required value="{{ old('password') }}">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" id="toggle-password" type="button" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></button>
          </div>
          @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Konfirmasi Password</label>
        <div class="input-group">
          <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm-password" placeholder="Masukkan Password disini" required value="{{ old('password_confirmation') }}">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" id="toggle-confirm-password" type="button" onclick="toggleComfirmPasswordVisibility()"><i class="fas fa-eye"></i></button>
          </div>
          @if ($errors->has('password_confirmation'))
            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >No WhatsApp</label>
        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Contoh : 0812345667890" required value="{{ old('no_hp') }}">
        @error('no_hp')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="text-start mt-2 mb-2 fw-bold" >Email </label>(Optional)
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Example: ardiangistin" required value="{{ old('email') }}">
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
              <div class="col">
                <input type="radio" name="status" class="btn-check" value="1" checked>
                <label class="btn btn-outline-purple w-100">Aktif</label>
              </div>
              <div class="col">
                <input type="radio" name="status" class="btn-check" value="0">
                <label class="btn btn-outline-purple w-100">Tidak Aktif</label>
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
    </div>
    <div class="col-12 mt-5">
      <div class="row">
        <div class="col-6"><button type="button" class="btn btn-outline-purple w-100" data-bs-dismiss="modal">Batal</button></div>
        <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
      </div>
    </div>
  </form>
</div>
<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var togglePassword = document.getElementById("toggle-password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.classList.add("hide");
    } else {
      passwordInput.type = "password";
      togglePassword.classList.remove("hide");
    }
  }

  function toggleComfirmPasswordVisibility() {
    var passwordInput = document.getElementById("confirm-password");
    var togglePassword = document.getElementById("toggle-confirm-password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.classList.add("hide");
    } else {
      passwordInput.type = "password";
      togglePassword.classList.remove("hide");
    }
  }
</script>
