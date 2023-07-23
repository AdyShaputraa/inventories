    <aside id="sidebar" class="sidebar">
      <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
          <img class="navbar-brand" src="/images/logo.png" alt="Logo">
        </div>
        <ul class="sidebar-nav" id="sidebar-nav">
          <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item {{ request()->is('barang') ? 'active' : '' }}">
            <a class="nav-link" href="/barang">
              <i class="bi bi-calendar2-event"></i>
              <span>Nama Barang</span>
            </a>
          </li>

          <li class="nav-item {{ request()->is('kerusakan') ? 'active' : '' }}">
            <a class="nav-link" href="/kerusakan">
              <i class="bi bi-exclamation-triangle"></i>
              <span>Kerusakan Barang</span>
            </a>
          </li>

          <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
            <a class="nav-link" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-person"></i><span style="text-start fw-bold">User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
                <a href="/user">
                  <i class="bi bi-person" ></i><span>User Acount</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('user/profile') ? 'active' : '' }}">
            <a class="nav-link" href="/user/profile">
              <i class="bi bi-gear"></i>
              <span>Setting</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>
  

