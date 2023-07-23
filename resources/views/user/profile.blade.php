@extends('layouts.main')
@section('content')
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="text-start mt-4 mb-4 fw-bold">
          <i class="fa-solid fa-cog text-purple"></i>&nbsp;
          <span class="fw-bold text-muted mr-4">Setting</span>
        </div>
        <div class="container">
          <img class="w-100" src="/images/background.svg" alt="Logo">
          <div style="margin-top: -90px; margin-left: 20px">
            @php $u = auth()->user(); @endphp
            <img src="{{ asset('storage/'.$u->photo) }}" alt="Profile" class="img-fluid img-thumbnail rounded-circle" style="height: 150px; width: 150px">
          </div>
          <div style="margin-top: -50px; margin-left: 20px"></div>
          <div class="col-2 offset-2">
            <h5 class="text-start fw-bold">{{ auth()->user()->nama_lengkap }}</h5>
            <span class="text-start text-muted">{{ auth()->user()->role }}</span>
          </div>
          <div class="col-12 mr-5 mt-3">
            <div class="row">
              <div class="col-2">
                <div class="btn-group-vertical">
                </div>
                <div class="card" style="width: 11rem;">
                  <ul class="list-group list-group-flush nav-customs">
                    <li class="list-group-item p-0 active">
                      <button type="button" class="btn btn-user-info w-100">
                        <i class="fa fa-user"></i> &nbsp; Informasi Profil
                      </button>
                    </li>
                    <li class="list-group-item p-0">
                      <button type="button" class="btn btn-change-password w-100">
                        <i class="fa fa-key"></i> &nbsp; Ubah Password
                      </button>
                    </li>
                    <li class="list-group-item p-0">
                      <button type="button" class="btn btn-change-photo w-100">
                        <i class="fa fa-image"></i> &nbsp; Ubah Foto
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-10" style="margin-left: -3px;">
                <div class="user-info">
                  <h5 class="text-start mt-4 fw-bold">Detail Pribadi</h5>
                  <span class="text-muted">Perbarui Foto dan Data Pribadi Anda</span>
                  <form action="/user/updateprofile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group mt-4">
                        <label class="text-start mt-2 mb-2">Nama lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Masukan Nama lengkap"  required value="{{ auth()->user()->nama_lengkap }}">
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-start mt-2 mb-2" >Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukan Username"  required value="{{ auth()->user()->username }}">
                        @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>  
                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="text-start mt-2 mb-2 teks-transparan" >Email</label>
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan Email disini untuk keperluan lupa password"  required value="{{ auth()->user()->email }}">
                      @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>  
                      @enderror
                    </div>
                    <div class="form-group">
                      <label class="text-start mt-2 mb-2" >No Whatsapp</label>
                      <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Masukan No Whatsapp disini.."  required value="{{ auth()->user()->no_hp }}">
                      @error('no_hp')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>  
                      @enderror
                    </div>
                    <div class="col-4 offset-8 mt-3 mb-3">
                      <div class="row">
                        <div class="col-6">
                          <a href="/user/profile">
                            <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                          </a>
                        </div>
                        <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="change-password">
                  <h5 class="text-start mt-4 fw-bold">Ubah Password</h5>
                  <span class="text-muted">Perbarui password disini</span>
                  <form method="POST" action="{{ route('user.password.update') }}">
                    @method('patch')
                    @csrf
                    <div class="form-group mt-4">
                      <label class="text-start mt-2 mb-2">Password Baru</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password baru disini" autocomplete="new-password" required>
                      @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label class="text-start mt-2 mb-2" for="password-confirm " class="">Konfirmasi Password Baru</label>
                      <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Masukan konfirmasi Password baru disini" autocomplete="new-password" required>
                      @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                      @endif
                    </div>
                    <div class="col-4 offset-8 mt-3 mb-3">
                      <div class="row">
                        <div class="col-6">
                          <a href="/user/profile">
                            <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                          </a>
                        </div>
                        <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="change-photo">
                  <h5 class="text-start mt-4 fw-bold">Ubah Foto</h5>
                  <span class="text-muted">Perbarui photo disini</span>
                  <form action="/user/{{ auth()->user()->id }}/updatephoto" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group mt-4">
                      <label for="photo" class="text-start mt-2 mb-2">Photo Profile</label>
                      <div class="row">
                        <div style="margin: auto; width: 100%; text-align: center;">
                          <div style="background-color: #f5e1f7; border-radius: 10px; border: 3px dashed rgba(226, 10, 247, 0.65);">
                            <div style="background-color: rgb(245, 225, 247); border-radius: 10px; padding: 10px;">
                              <div class="drag-file">
                                <img class="navbar-brand" src="/images/frame.png" alt="Logo"><br>
                                <input type="file" name="image" class="form-control-file" id="photo" accept="image/*" required value="{{ old('image') }}" style="visibility: hidden"><br>
                                <label class="drag-file-text" for="photo" id="fileNameLabel3"><b>Drag File Gambar Disini</b> <br> atau klik area ini dan pilih File Gambar</label><br><br>
                              </div>
                              @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 offset-8 mt-3 mb-3">
                      <div class="row">
                        <div class="col-6">
                          <a href="/user/profile">
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
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('.user-info').show(); $('.change-password').hide(); $('.change-photo').hide();
  $(document).ready(function(){
    $('.btn-user-info').on('click', function() {
      $('.user-info').show(); $('.change-password').hide(); $('.change-photo').hide();
    });

    $('.btn-change-password').on('click', function() {
      $('.user-info').hide(); $('.change-password').show(); $('.change-photo').hide();
    });

    $('.btn-change-photo').on('click', function() {
      $('.user-info').hide(); $('.change-password').hide(); $('.change-photo').show();
    });

    $('ul.nav-customs > li').click(function (e) {
      e.preventDefault();
      $('ul.nav-customs > li').removeClass('active');
      $(this).addClass('active');
    });
  });
</script>
<script>
  document.getElementById('photo').addEventListener('change', function (event) {
    var fileName = event.target.files[0].name;
    document.getElementById('fileNameLabel3').textContent = fileName;
  });
</script>
@endsection