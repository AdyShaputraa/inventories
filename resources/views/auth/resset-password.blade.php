<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <title>Reset Password</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-sm-4 px-0 d-none d-sm-block">
          <img src="/images/forgotpassword.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: fill;">
        </div>
        <div class="col-sm-6 mx-auto">
          <div class="">
            @if (\Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
              
            @if (\Session::has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form action="{{ route('password.update') }}" method="post"> 
              <div class="fs-3 fw-bold">Ubah Password</div>
              <div class="fs-5 fw-lighter text-muted mb-4">Masukan Password Baru anda, Masukan password yang mudah diingat agar dikemudian hari tidak lupa.</div>
              
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="col-sm-12">
                <div class="row">
                  <div class="mb-3">
                    <label for="password" class="text-start fw-bold">Password Baru</label>
                    <input type="password" name="password" class="form-control mb-3 mt-3" id="password" placeholder="Masukan Password baru disini" required autofocus>
                    @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="mb-3">
                    <label class="text-start fw-bold" for="password-confirm" class="">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control mb-3 mt-3" id="password-confirm" placeholder="Masukan konfirmasi Password baru disini" required>
                    @if ($errors->has('password_confirmation'))
                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              
              <button class="btn btn-purple mt-5 w-100" type="submit">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>