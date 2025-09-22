@extends('landing.template.home_temp')

@section('judul','Okacake - Home')

@section('konten')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Rincian Pesanan</h3>
                <table>
                    <tr>
                        <td width="200px">ID Pesanan</td>
                        <td>: {{ $transaksi->id }}</td>
                        <td width="100px"></td>
                        <td width="200px">Nama Pemesan</td>
                        <td>: {{ $transaksi->user->profile->nama }}</td>
                    </tr>
                    <tr>
                        <td width="200px">Status Pesanan</td>
                        <td>: {{ $transaksi->status}}</td>
                        <td width="100px"></td>
                        <td width="200px">Alamat</td>
                        <td>: {{ $transaksi->user->profile->alamat }}</td>
                    </tr>
                    <tr>
                        <td width="200px">Info Kurir</td>
                        <td>: {{ $transaksi->kurir->profile->nama }} - {{ $transaksi->kurir->profile->no_hp }}</td>
                        <td width="100px"></td>
                        <td width="200px">Nomor HP</td>
                        <td>: {{ $transaksi->user->profile->no_hp }}</td>
                    </tr>
                     @if($transaksi->status == 'Ditolak')
                    <tr style="font-weight: bold;">
                        <td width="200px">Keterangan</td>
                        <td colspan="4">: {{ $transaksi->ket }}</td>
                    </tr>
                    @endif
                    
                </table>
                <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaksi->detTemp as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kue->nama }}</td>
                                    <td>
                                        {{ $data->jumlah }} {{ $data->kue->satuan->nama }}
                                    </td>
                                    <td><span class="harga">Rp. {{ number_format($data->kue->harga) }}</span></td>
                                    <td>
                                        <span class="subtotal">Rp. {{ number_format($data->bayar) }}</span>
                                    </td>
                                        
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-center"><strong>Total Harga</strong></td>
                                    <td><strong><span id="grandTotal">Rp. {{ number_format($transaksi->total) }}</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- input hidden untuk total --}}
                    <input type="hidden" name="grand_total" id="grandTotalInput">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="{{ route('landing') }}" class="btn btn-secondary me-2">Kembali</a>
                            @if($transaksi && in_array($transaksi->status, ['Belum Bayar', 'Ditolak']))
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload">Pembayaran</a>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
                <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="uploadLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="uploadLabel">Upload Bukti Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('keranjang.upload') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            
                            <table class="table table-bordered">
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <img 
                                                id="preview" 
                                                src="{{ $transaksi->bukti_bayar ? asset($transaksi->bukti_bayar) : '#' }}" 
                                                alt="Bukti Pembayaran Belum Ada" 
                                                style="max-height: 200px; {{ $transaksi->bukti_bayar ? '' : 'display:none;' }} margin: 20px auto" 
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @if($transaksi->status == 'Belum Bayar' || $transaksi->status == 'Ditolak')
                                            <input
                                                type="file"
                                                class="form-control-file"
                                                id="foto"
                                                name="foto"
                                                onchange="previewFoto(event)"
                                            />
                                             @endif
                                           
                                        </td>
                                    </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            @if($transaksi->status == 'Belum Bayar' || $transaksi->status == 'Ditolak')
                            <button type="submit" class="btn btn-primary"> Upload Bukti Pembayaran</button>
                            @endif
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
</section>

@endsection
