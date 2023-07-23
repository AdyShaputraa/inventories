@extends('dashboard.layouts.main')
@section('container')
<div class="container">
  <main id="main" class="main">
    <section class="">
      <div class="row">
        <div class="text-start mt-4 mb-4 fw-bold"><i class="bi bi-gear"></i>
          Setting
        </div>

        <div class="profil">
          <div class="upper">
            <img class="d-flex justify-content-center align-items-center" src="/images/background.svg" alt="Logo">
           </div>

           <div class="user">
            <div class="photo">
              @php
              $u = auth()->user();
           @endphp
           <img src="{{ asset('storage/'.$u->photo) }}" alt="Profile" class="rounded-circle">
            </div>
           </div>
            <div class="user-row ">
              <div class="text-start fw-bold">{{ auth()->user()->nama_lengkap }}</div>
              <div class="text-start teks-transparan">{{ auth()->user()->role }}</div>
             </div>
           </div>
        </div>
            
    
            <div class="row">
              <div class="col-lg-3">
                <li class="link-nav">
                  <a class="text-align: center; mt-3 mb-3" href="/user/profile">
                    <i class="bi bi-person"></i>
                    Informasi Pribadi
                  </a>
                  <a class="text-align: center; mt-3 mb-3" href="{{ route('user.password.edit') }}">
                    <i class="bi bi-key"></i>
                    Ubah Password
                  </a>
                </li>
            </div>


              <div class="col-lg-6">
                <div class="text-start mt-4 mb-4 fw-bold"></i>
                  Ubah Password
                </div>
            
                <div class="text-start mt-4 mb-4 teks-transparan"></i>
                  Perbarui Password disini
              </div>

        <div class="card-body">
          @if(session('error'))
          <div class="alert alert-danger " role='alert'>
              {{ session('error') }}
          </div>
          @endif

          
      </div>
              </div>
            </div>
      </div>
    </section>
  </main><!-- End #main -->
</div>

@endsection