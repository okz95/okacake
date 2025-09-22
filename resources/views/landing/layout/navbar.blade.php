<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
      <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span style="color: #b50350">Your cart</span>
            @if ( $transaksi )
                      <span class="badge rounded-pill" style="background-color: #b50350">{{ $transaksi->detTemp->count() }}</span>
            @endif
          </h4>
          <ul class="list-group mb-3">
              @guest
                  {{-- Kalau belum login --}}
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                      <div>
                          <h6 class="my-0 text-danger">Silakan login untuk melihat atau membuat pesanan</h6>
                      </div>
                  </li>
              @else
                  {{-- Kalau sudah login --}}
                  @if(!$transaksi)
                      <li class="list-group-item d-flex justify-content-between lh-sm">
                          <div>
                              <h6 class="my-0">Belum Ada Pesanan</h6>
                          </div>
                      </li>
                  @else
                      @foreach ($transaksi->detTemp as $item)
                          <li class="list-group-item">
                              <h6 class="d-flex justify-content-between align-items-center mb-3">
                                <span>{{ $item->kue->nama }}</span>
                                <span class="badge rounded-pill" style="background-color: #b50350">{{ $item->jumlah }}</span>
                              </h6>
                                  <h6 class="my-0"></h6>
                                  <span class="text-body-secondary">Rp.{{ number_format($item->bayar) }}</span>
                          </li>
                      @endforeach
                      <li class="list-group-item d-flex justify-content-between">
                          <span>Total</span>
                          <strong>Rp.{{ number_format($transaksi->detTemp->sum('bayar')) }}</strong>
                      </li>
                      @if ($transaksi->status == 'pesan')
                      <a class="w-100 btn btn-primary btn-lg" href="{{ route('keranjang.pesanan') }}">Checkout Sekarang..</a>
                      @else
                      <a class="w-100 btn btn-primary btn-lg" href="{{ route('keranjang.bayar') }}">Pesanan Anda</a>
                      @endif
                  @endif
              @endguest
          </ul>
        </div>
      </div>
    </div>

    <header>
      <div class="container-fluid">
        <div class="row py-3 border-bottom">
          
          <div class="col-sm-4 col-lg-8 text-center text-sm-start">
            <div class="main-logo">
              <a href="#">
                <img src="{{ asset('landing/images/logo.png')}}" alt="logo" class="img" height="100px">
              </a>
            </div>
          </div>
          
          <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
            @guest
              <a href="{{ route('auth.login') }}" class="btn btn-primary">Login</a>
            @else
               
              <div class="cart text-end d-none d-lg-block dropdown">
              <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <span class="fs-6 text-muted dropdown-toggle">Pesanan Kamu :</span>
                <span class="cart-total fs-8 text-dark">
                  @if ( $transaksi )
                      {{ $transaksi->detTemp->count() }} Produk
                  @else
                      Belum ada pesanan
                  @endif
                  {{-- {{ Auth::user()->transaksi->detTemp->count() ?? 0 }}</span> --}}
              </button>
            </div>
            @endguest
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row py-3">
          <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
            <nav class="main-menu d-flex navbar navbar-expand-lg">

              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header justify-content-center">
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                    <li class="nav-item">
                      <a href="#brand" class="nav-link">Brand</a>
                    </li>
                    <li class="nav-item">
                      <a href="#sale" class="nav-link">Sale</a>
                    </li>
                    <li class="nav-item">
                      <a href="#blog" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                       @if (Auth::check())
                          <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link">Logout</button>
                          </form>
                        @endif
                    </li>
                  </ul>
                
                </div>

              </div>
          </div>
        </div>
      </div>
    </header>