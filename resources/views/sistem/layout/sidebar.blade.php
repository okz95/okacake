<body>
    <div class="wrapper">
      <div class="sidebar" data-background-color="white">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="white">
              <img
                src="{{ asset('sistem/assets/img/logo.png')}}"
                alt="navbar brand"
                class="navbar-brand"
                height="40"
              />
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a href="{{ route('dashboard') }}">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  {{-- <span class="caret"></span> --}}
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#profile">
                  <i class="fas fa-user"></i>
                  <p>Profil</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="profile">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('toko.index') }}">
                        <span class="sub-item">Toko</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('profile.index') }}">
                        <span class="sub-item">Pengguna</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              {{-- <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li> --}}
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Master</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('kue.index') }}">
                        <span class="sub-item">Kue</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('kategori.index') }}">
                        <span class="sub-item">Kategori</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('satuan.index') }}">
                        <span class="sub-item">Satuan</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaksi.index') }}">
                  <i class="fas fa-cart-arrow-down"></i>
                  <p>Pemesanan</p>
                  {{-- <span class="badge badge-success">{{ $transaksi->count() }}</span> --}}
                  {{-- <span class="caret"></span> --}}
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#riw-trans">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Riwayat Transaksi</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="riw-trans">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('transaksi.dikirim') }}">
                        <span class="sub-item">Transaksi Dikirim</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('transaksi.laporan') }}">
                        <span class="sub-item">Laporan Transaksi</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="{{ route('auth.logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                  class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>