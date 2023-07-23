<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <title>Forgot Password</title>
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
          @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
            
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              @foreach ($errors->all() as $error )
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          
          <form action="{{ route('password.email') }}" method="post"> 
            <div class="fs-3 fw-bold">Lupa Password</div>
            <div class="fw-lighter text-muted mb-4">Masukan Email Anda dibawah ini, kami akan mengirimkan link ubah password ke email anda.</div>
            @csrf 
            <div class="col-sm-12">
              <div class="row">
                <div class="mb-3">
                  <label for="email" class="text-start mt-2 mb-2">Email</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder="Masukan Email Anda Disini" required autofocus>
                  @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <button class="btn btn-md btn-purple mt-4 w-100" type="submit">Kirim</button>
            <small class="d-block text-center mt-5">Sudah ingat? <a href="/login" class="fw-bold text-decoration-none text-purple">Login</a></small>  
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- <div id="mainContainer">
    <div class="">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-xs-12 d-none d-lg-block d-md-block">
        <div id="mainBgn">
      <img src="/images/forgotpassword.jpg" class="img w-100 h-100" alt="">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="p-4 centerOnMobile" >
          <div class="formContainer">
             @if ($errors->any())
             <div class="alert alert-danger">
               <ul>
                 @foreach ($errors->all() as $error )
                   <li>{{ $error }}</li>
                 @endforeach
               </ul>
             </div>
             @endif
             @if (session()->has('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session('success')}}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
             @endif

             <div class="fs-2  fw-bold">Lupa Password</div>
             <div class="fs-5">Masukan Email Anda dibawah ini, kami akan mengirimkan link ubah
               password ke email anda. </div>
            <form action="{{ route('password.email') }}" method="post"> 
              @csrf 
              <div class="mb-3">
                </div>
                 
                
              <div id="btnHolder">
                <button class="btn btn-lg btn-primary mt-3 w-100" type="submit">Kirim</button>
                <small class="d-block  text-center mt-3">Sudah ingat? <a href="/login">Login</a></small>  
              </div>
             
              </form>
          </div>
          
        </div>
      </div>
    </div>
    </div>
    </div> -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>