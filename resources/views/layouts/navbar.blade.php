<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="col-12 mt-3">
        <div class="row">
            <div class="col-xs-3 col-sm-5 col-md-5 col-lg-5">
                <div class="border rounded bg-light">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control menu-search-input-autocomplete" placeholder="Cari Menu Disini" aria-label="Cari Menu Disini" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-1 col-md-1 col-lg-1 offset-sm-6 offset-md-6 offset-lg-6">
                <nav class="header-nav">
                    
                    <ul class="d-flex align-items-center">
                        <li class="nav-item dropdown">
                            @php $u = auth()->user(); @endphp
                            <a class="nav-link nav-profile d-flex align-items-center ps-4" href="#" data-bs-toggle="dropdown" id="dropdownMenuLink" aria-expanded="false">
                                <img src="{{ asset('storage/'.$u->photo) }}" alt="Profile" class="rounded-circle">
                                <span class="d-none d-md-block dropdown-toggle ps-3"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" aria-labelledby="dropdownMenuLink">
                                <li class="dropdown-header">
                                    <span class="fw-bold d-flex justify-content-start">{{ auth()->user()->nama_lengkap }}</span>
                                    <span class="fw-lighter text-muted d-flex justify-content-start">{{ auth()->user()->role }}.</span>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/user/profile">
                                        <i class="bi bi-gear"></i>
                                        <div class="row ml-2">
                                            <button class="btn button-like-link text-bold" type="button" style="border: none !important;"><span>Account Settings</span></button>
                                        </div>
                                    </a>
                                </li>
                                <form action="/login/logout" method="post">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <div class="row">
                                                @csrf
                                                <button class="btn button-like-link text-bold" type="submit" style="border: none !important;"><span>Signout</span></button>
                                            </div>
                                        </a>
                                    </li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>