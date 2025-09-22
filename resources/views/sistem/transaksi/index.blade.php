@extends('sistem.template.sistem_temp')

@section('judul','Okacake - Transaksi')

@section('konten')
    <div class="container">
          <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Transaksi Pemesanan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nama Pemesan</th>
                            <th>Telepon</th>
                            <th>Tanggal Pesan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nama Pemesan</th>
                            <th>Telepon</th>
                            <th>Tanggal Pesan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @if ($transaksi->isEmpty())
                              <tr>
                                  <td colspan="7" class="text-center"><b>Data Tidak Ditemukan!</b></td>
                              </tr>
                          @else
                              @foreach ($transaksi as $data)
                                  <tr>
                                      <td>
                                        @if(Route::currentRouteName() === 'transaksi.index')
                                        <a href="#" style="margin-left : 0.1px" title="Lihat" data-bs-toggle="modal" data-bs-target="#lihat{{ $data->id }}" class="d-inline-block">
                                          <span class="badge badge-success">
                                            Lihat
                                          </span>
                                        </a>

                                        <a href="#" style="margin-left : 0.1px" title="Ubah" data-bs-toggle="modal" data-bs-target="#konf{{ $data->id }}" class="d-inline-block" >
                                          <span class="badge badge-primary">
                                            Konfirmasi
                                          </span>
                                        </a>
                                        @else
                                        <a href="#"style="margin-left : 0.1px" class="d-inline-block" title="lihat-kirim" data-bs-toggle="modal" data-bs-target="#lihat-kirim{{ $data->id }}">
                                          <span class="badge badge-secondary">
                                            <i class="far fa-eye"></i>
                                          </span>
                                        </a>

                                        <a href="#" style="margin-left : 0.1px" title="cetak-terima" class="d-inline-block" onclick="window.open('{{ route('transaksi.cetak', $data->id) }}', 'googleWindow', 'width=1000,height=700'); return false;">
                                          <span class="badge badge-info">
                                            <i class="fas fa-print"></i>
                                          </span>
                                        </a>

                                        @endif
                                      </td>
                                      <td>{{ $data->id }}</td>
                                      <td>{{ $data->user->profile->nama }}</td> 
                                      <td>{{ $data->user->profile->no_hp }}</td>
                                      <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                                      <td>Rp.{{ number_format($data->total) }}</td>
                                      <td>
                                        @if ($data->status == 'Memproses Pembayaran')
                                            <span class="badge badge-warning">Memproses <br> Pembayaran</span>
                                        @elseif ($data->status == 'Ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @elseif ($data->status == 'Dikirim')
                                            <span class="badge badge-success">Dikirim</span>
                                        @endif
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
         @if ($transaksi != NULL)
        @foreach ($transaksi as $data)
          <!-- Modal Lihat -->
          <div class="modal fade" id="lihat{{ $data->id }}" tabindex="-1" aria-labelledby="lihatLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="lihatLabel{{ $data->id }}">Detail Transaksi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                  <div class="card-body">
                    <table class="table table-bordered">
                     <tr>
                          <td rowspan="2" class="text-center" style="background-color: gray;">
                            <img 
                            src="{{ asset($data->bukti_bayar) }}" 
                            alt="{{ $data->bukti_bayar }}"
                            height="120px">
                          </td>
                          <td class="fw-bold">ID Transaksi</td>
                          <td colspan="2">{{ $data->id }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Total Pembayaran</td>
                          <td class="fw-bold fs-4" colspan="2">Rp.{{ number_format($data->total) }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Pemesan</td>
                          <td>{{ $data->user->profile->nama }}</td>
                          <td class="fw-bold">Telepon</td>
                          <td>{{ $data->user->profile->no_hp }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Alamat</td>
                          <td colspan="3">{{ $data->user->profile->alamat }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="dt">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data->detTemp as $dt)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dt->kue->nama }}</td>
                                    <td>
                                        {{ $dt->jumlah }} {{ $dt->kue->satuan->nama }}
                                    </td>
                                    <td><span class="harga">Rp. {{ number_format($dt->kue->harga) }}</span></td>
                                    <td>
                                        <span class="subtotal">Rp. {{ number_format($dt->bayar) }}</span>
                                    </td>
                                        
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="4" class="text-center"><strong>Total Harga</strong></td>
                                    <td><strong><span id="grandTotal">Rp. {{ number_format($transaksi->total) }}</span></strong></td>
                                </tr> --}}
                            </tbody>
                        </table>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          {{-- Tutup Modal Lihat --}}

    <!-- Modal lihat-kirim -->
          <div class="modal fade" id="lihat-kirim{{ $data->id }}" tabindex="-1" aria-labelledby="lihat-kirimLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="lihat-kirimLabel{{ $data->id }}">Transaksi Pengiriman</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                              <tr>
                                <th colspan="4" class="fw-bold text-center">Detail Pengiriman</th>
                              </tr>
                              <tr>
                                    <td rowspan="4" class="text-center" style="background-color: gray;">
                                      <img 
                                      src="{{ asset($data->pengiriman->bukti_sampai) }}" 
                                      alt="{{ $data->pengiriman->bukti_sampai }}"
                                      height="120px">
                                    </td>
                                    <td class="fw-bold">ID Pengiriman</td>
                                    <td>{{ $data->pengiriman->id }}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Kurir</td>
                                    <td>{{ $data->kurir->profile->nama }} - {{ $data->kurir->profile->no_hp }}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Status Pengiriman</td>
                                    <td class="fw-bold">
                                      <span class="badge badge-success fs-5">{{ $data->status }}</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Ongkos Kirim</td>
                                    <td class="fw-bold fs-4">Rp.{{ number_format($data->pengiriman->ongkir) }}</td>
                                  </tr>
                              </table>
                      </div>
                      <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                              <tr>
                                <th colspan="4" class="fw-bold text-center">Detail Transaksi</th>
                              </tr>
                              <tr>
                                    <td rowspan="2" class="text-center" style="background-color: gray;">
                                      <img 
                                      src="{{ asset($data->bukti_bayar) }}" 
                                      alt="{{ $data->bukti_bayar }}"
                                      height="120px">
                                    </td>
                                    <td class="fw-bold">ID Transaksi</td>
                                    <td colspan="2">{{ $data->id }}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Total Pembayaran</td>
                                    <td class="fw-bold fs-4" colspan="2">Rp.{{ number_format($data->total) }}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Pemesan</td>
                                    <td>{{ $data->user->profile->nama }}</td>
                                    <td class="fw-bold">Telepon</td>
                                    <td>{{ $data->user->profile->no_hp }}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Alamat</td>
                                    <td colspan="3">{{ $data->user->profile->alamat }}</td>
                                  </tr>
                              </table>
                      </div>
                    </div>
                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="dt">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data->detTemp as $dt)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dt->kue->nama }}</td>
                                    <td>
                                        {{ $dt->jumlah }} {{ $dt->kue->satuan->nama }}
                                    </td>
                                    <td><span class="harga">Rp. {{ number_format($dt->kue->harga) }}</span></td>
                                    <td>
                                        <span class="subtotal">Rp. {{ number_format($dt->bayar) }}</span>
                                    </td>
                                        
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="4" class="text-center"><strong>Total Harga</strong></td>
                                    <td><strong><span id="grandTotal">Rp. {{ number_format($transaksi->total) }}</span></strong></td>
                                </tr> --}}
                            </tbody>
                        </table>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          {{-- Tutup Modal Lihat-kirim --}}

           <!-- Modal konf -->
          <div class="modal fade" id="konf{{ $data->id }}" tabindex="-1" aria-labelledby="konfLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="konfLabel{{ $data->id }}">Konfirmasi Pemesanan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('transaksi.konfirmasi', $data->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                <div class="modal-body">
                  <div class="card">
                  <div class="card-body">
                    <table class="table table-bordered">
                      <tr>
                          <td rowspan="2" class="text-center" style="background-color: gray;">
                            <img 
                            src="{{ asset($data->bukti_bayar) }}" 
                            alt="{{ $data->bukti_bayar }}"
                            height="120px">
                          </td>
                          <td class="fw-bold">ID Transaksi</td>
                          <td colspan="2">{{ $data->id }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Total Pembayaran</td>
                          <td class="fw-bold fs-4" colspan="2">Rp.{{ number_format($data->total) }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Pemesan</td>
                          <td>{{ $data->user->profile->nama }}</td>
                          <td class="fw-bold">Telepon</td>
                          <td>{{ $data->user->profile->no_hp }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Alamat</td>
                          <td colspan="3">{{ $data->user->profile->alamat }}</td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Pilih Konfirmasi</td>
                          <td colspan="3">
                          <div class="form-group">
                            <select
                              class="form-select"
                              id="status{{ $data->id }}"
                              name="status"
                              required
                              onchange="konfirmasi({{ $data->id }})">
                              <option value="" selected disabled>-- Pilih Konfirmasi --</option>
                              <option value="Diterima">Diterima</option>
                              <option value="Ditolak">Ditolak</option>
                            </select>
                          </div>
                          </td>
                        </tr>
                        <tr id="lanjutan{{ $data->id }}">
                        </tr>
                    </table>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi Pesanan?')">Konfirmasi</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          {{-- Tutup Modal konf --}}
        @endforeach
        @endif
@endsection
@push('js')
    <script>
        function konfirmasi(id) {
          var select = document.getElementById("status" + id);
          var selectedValue = select.value;

          if (selectedValue === "Diterima") {
              document.getElementById("lanjutan" + id).innerHTML = `
                  <td class="fw-bold">Pilih Kurir</td>
                  <td>
                      <div class="form-group">
                          <select class="form-select" id="kurir_id${id}" name="kurir_id"
                              required onchange="kurir(${id})">
                              <option value="" selected disabled>-- Pilih Kurir --</option>
                              @foreach ($kurir as $k)
                                  <option value="{{ $k->id }}">{{ $k->profile->nama }} - {{ $k->profile->no_hp }}</option>
                              @endforeach
                          </select>
                      </div>
                  </td>
                  <td class="fw-bold">Masukan Ongkos Kirim</td>
                  <td>
                  <div class="form-group">
                          <input type="number" class="form-control" name="ongkir" id="ongkir${id}" required/>
                      </div>
                  </td>
              `;
          } else if (selectedValue === "Ditolak") {
              document.getElementById("lanjutan" + id).innerHTML = `
                  <td class="fw-bold">Alasan Penolakan</td>
                  <td colspan="3">
                      <div class="form-group">
                          <textarea class="form-control" id="ket${id}" name="ket" rows="3"
                              placeholder="Masukkan alasan penolakan..." required></textarea>
                      </div>
                  </td>
              `;
          }
      }

    </script>
    
@endpush