<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item text-center mt-5">
            <div class="navbar-header">
                <img class="navbar-brand" src="/images/logo.png" alt="Logo">
            </div>
        </li>
        <li class="nav-item mt-5 {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('barang') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="/barang">
                <i class="bi bi-calendar2-event"></i>
                <span>Nama Barang</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('kerusakan') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="/kerusakan">
                <i class="bi bi-exclamation-triangle"></i>
                <span>Kerusakan Barang</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
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
            <a class="nav-link collapsed" href="/user/profile">
                <i class="bi bi-gear"></i>
                <span>Setting</span>
            </a>
        </li>
    
        <form action="/login/logout" method="post">
            <li class="nav-item" style="position: absolute; bottom: 0; width: 260px; z-index: 996; transition: all 0.3s; overflow-y: auto; background-color: #fff">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-box-arrow-right"></i>
                    @csrf
                    <button class="btn text-start" type="submit" style="width: 220px; border: none !important;"><span>Signout</span></button>
                </a>
            </li>
        </form>
    </ul>
</aside>