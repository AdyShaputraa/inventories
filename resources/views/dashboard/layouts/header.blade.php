  <header id="header" class="header fixed-top d-flex align-items-center">
  
    <div class="search-bar">
      <div class="search-form">
        <div class="input-group">
          <input type="text" class="form-control rounded" placeholder="Cari Menu Disini" aria-label="Cari Menu Disini" aria-describedby="addon-wrapping">
          <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
        </div>
      </div>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @php $u = auth()->user(); @endphp
            <img src="{{ asset('storage/'.$u->photo) }}" alt="Profile" class="rounded-circle">
            <i class="bi bi-chevron-down ml-2"></i>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span class="fw-bold d-flex justify-content-start">{{ auth()->user()->nama_lengkap }}</span>
              <span class="fw-lighter text-muted d-flex justify-content-start">{{ auth()->user()->role }}.</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/user/profile">
                <i class="bi bi-gear"></i>
                <button class="button-like-link text-bold" type="button"><i class=""></i><span>Account Settings</span></button>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <div class="row">
                  <form action="/login/logout" method="post">
                    @csrf
                    <button class="button-like-link text-bold" type="submit"><i class=""></i><span>Signout</span></button>
                  </form>
                </div>
              </a>
            </li>

          </ul>

          <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <span class="fw-bold d-flex justify-content-start">{{ auth()->user()->nama_lengkap }}</span>
              <span class="fw-lighter text-muted d-flex justify-content-start">{{ auth()->user()->role }}.</span>
            </li>
            <li>
              <a class="dropdown-item" href="/user/profile">
                <span>Account Settings</span>
              </a>
            </li>
            <li class="dropdown-item d-flex justify-content-start">
              <a href="#">
                <form action="/login/logout" method="post">
                  @csrf
                  <button class="button-like-link text-bold" type="submit"><i class=""></i><span>Signout</span></button>
                </form>
              </a>
            </li>

          </ul> -->
        </li>
      </ul>
    </nav>


    <script>
      $(function() {
          $("#searchInput").autocomplete({
              source: function(request, response) {
                  // Lakukan permintaan AJAX ke server untuk mendapatkan data autokomplet
                  $.ajax({
                      url: "/api/search", // Ganti dengan URL endpoint yang sesuai
                      dataType: "json",
                      data: {
                          search: request.term
                      },
                      success: function(data) {
                          response(data);
                      }
                  });
              },
              minLength: 2 // Jumlah karakter minimum sebelum autokomplet muncul
          });
      });
    </script>
  </header>
  