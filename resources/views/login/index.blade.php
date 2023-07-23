<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <title>Login</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-sm-4 px-0 d-none d-sm-block">
          <img src="/images/Group.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: fill;">
        </div>
        <div class="col-sm-6 mx-auto">
          <div class="">
            @if (\Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            
            @if (\Session::has('fail'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif  
              
            @if (\Session::has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form action="/login" method="post"> 
              <div class="fs-3 fw-bold">Login</div>
              <div class="fs-5 fw-lighter text-muted mb-4">Selamat Datang! Tolong masukan informasi login anda</div>
              
              @csrf 
              <div class="col-sm-12">
                <div class="row">
                  <div class="form-group mb-3">
                    <label class="text-start mt-2 mb-2 fw-bold" for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" autocomplete="username" placeholder="Silahkan Isi Username anda disini"  autofocus required value="{{ old('username') }}">
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>  
                    @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label class="text-start mt-2 mb-2 fw-bold" for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Silahkan isi Password anda disini" autocomplete="current-password" required>
                  </div>
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6 d-flex justify-content-start">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                          <label class="form-check-label" for="remember"> Remember me </label>
                        </div>
                      </div>
                      <div class="col-sm-6 d-flex justify-content-end">
                        <a href="/login/forgot-password" class="text-decoration-none text-purple">Lupa Password ?</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <button class="btn btn-purple mt-5 w-100" type="submit">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>