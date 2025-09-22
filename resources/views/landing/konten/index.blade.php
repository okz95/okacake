@extends('landing.template.home_temp')

@section('judul','Okacake - Home')

@section('konten')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="row">

<!-- Modal -->
                    @foreach($kue as $data)
                    <div class="product-item col-md-3 position-relative">
                        <figure>
                            <a href="#" title="{{ $data->nama }}" data-bs-toggle="modal" data-bs-target="#produk{{ $data->id }}">
                                <img src="{{ asset($data->foto) }}" class="tab-image">
                            </a>
                        </figure>
                        <h3>{{ $data->nama }}</h3>
                        <span class="qty"> Tersedia : {{ $data->stok }} {{ $data->satuan->nama }}</span>
                        <span class="price">Rp.{{ number_format($data->harga) }}</span>
                        <div class="d-flex align-items-center justify-content-end">
                            @guest
                                {{-- <button type="submit" class="btn btn-primary" onclick="return confirm('Masukkan produk ke dalam keranjang?');">
                                        <i class="fas fa-cart-plus"></i>
                                </button> --}}
                                <a href="{{ route('auth.login') }}" class="btn btn-primary">
                                    <i class="fas fa-cart-plus"></i>
                                </a>
                                @else
                                    <form action="{{ route('keranjang.tbh_produk') }}" method="POST" class="me-2">
                                        @csrf
                                        <input type="hidden" name="kue_id" value="{{ $data->id }}">
                                        <input type="hidden" name="jumlah_beli" value="1">
                                        @if ($transaksi)
                                            <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">

                                            @php
                                                // cek apakah produk ini sudah ada di detTemp
                                                $sudahAda = $transaksi->detTemp->contains('kue_id', $data->id);
                                            @endphp

                                            @if (!$sudahAda)
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Masukkan produk ke dalam keranjang?');">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            {{-- @else
                                                <button type="button" class="btn btn-secondary" disabled>
                                                    <i class="fas fa-check"></i> Sudah di keranjang
                                                </button> --}}
                                            @endif
                                        @else
                                            {{-- kalau transaksi belum ada, tombol tetap tampil --}}
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Masukkan produk ke dalam keranjang?');">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        @endif
                                    </form>
                            @endguest
                            
                        </div>
                    </div>

                    <div class="modal fade" id="produk{{ $data->id }}" tabindex="-1" aria-labelledby="produk{{ $data->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="produk{{ $data->id }}Label">Detail Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                            <tr>
                                <td colspan="2" class="text-center" style="background-color: gray;">
                                    <img 
                                    src="{{ asset($data->foto) }}" 
                                    alt="{{ $data->foto }}"
                                    height="200px">
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Kue</td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $data->kategori->nama }}</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $data->stok }} {{ $data->satuan->nama }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>Rp.{{ number_format($data->harga) }} / {{ $data->satuan->nama }}</td>
                            </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection