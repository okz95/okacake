@extends('landing.template.home_temp')

@section('judul','Okacake - Home')

@section('konten')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Pesanan Anda</h3>
                <hr>
               <form action="{{ route('keranjang.update_pesanan') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td></td>
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
                                    <td>
                                        @if($transaksi->status == 'pesan')
                                            <button type="button" class="btn btn-sm" style="background-color: rgb(140, 0, 0)"
                                                onclick="if(confirm('Yakin ingin menghapus pesanan?')) { 
                                                    event.preventDefault(); 
                                                    document.getElementById('hapus-form-{{ $data->id }}').submit();
                                                }">
                                                <i class="fa fa-trash" style="color:white"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kue->nama }}</td>
                                    <td>
                                        
                                        <input type="hidden" name="detail_id[]" value="{{ $data->id }}">
                                        <input type="number" 
                                            name="jumlah[]" 
                                            class="form-control jumlah" 
                                            value="{{ $data->jumlah }}" 
                                            min="1">
                                    </td>
                                    <td>Rp. <span class="harga">{{ $data->kue->harga }}</span></td>
                                    <td>
                                        Rp. <span class="subtotal">{{ $data->jumlah * $data->kue->harga }}</span>
                                        <input type="hidden" name="subtotal[]" class="subtotal-input" value="{{ $data->jumlah * $data->kue->harga }}">
                                        <input type="hidden" 
                                            name="bayar[]" 
                                            class="form-control bayar" 
                                            value="{{ $data->jumlah * $data->kue->harga }}" 
                                            min="0">
                                    </td>
                                        
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-center"><strong>Total Harga</strong></td>
                                    <td><strong>Rp. <span id="grandTotal">0</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- input hidden untuk total --}}
                    <input type="hidden" name="grand_total" id="grandTotalInput">
                    @if($transaksi->status == 'pesan')
                    <div class="text-end">
                        <button type="submit" class="btn btn-success me-2">Update Pesanan</button>
                        <a href="{{ route('keranjang.konfirmasi') }}" class="btn btn-primary">Konfirmasi Pesanan</a>
                    </div>
                    @endif
                    
                </form>
                @foreach ($transaksi->detTemp as $dt)
                <form id="hapus-form-{{ $dt->id }}" 
                    action="{{ route('keranjang.hapus', $dt->id) }}" 
                    method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach

            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const jumlahInputs = document.querySelectorAll(".jumlah");
    const grandTotalElement = document.getElementById("grandTotal");
    const grandTotalInput = document.getElementById("grandTotalInput");

    function hitungTotal() {
        let grandTotal = 0;

        document.querySelectorAll("tbody tr").forEach(row => {
            const harga = parseInt(row.querySelector(".harga")?.innerText || 0);
            const jumlah = parseInt(row.querySelector(".jumlah")?.value || 0);
            const subtotalElement = row.querySelector(".subtotal");
            const subtotalInput = row.querySelector(".subtotal-input");
            const bayarInput = row.querySelector(".bayar");

            if (subtotalElement && subtotalInput && bayarInput) {
                let subtotal = harga * jumlah;

                // update subtotal tampilan & input hidden
                subtotalElement.innerText = subtotal.toLocaleString();
                subtotalInput.value = subtotal;

                // default bayar = subtotal (bisa diubah user)
                if (!bayarInput.value || bayarInput.value == "0") {
                    bayarInput.value = subtotal;
                }

                grandTotal += subtotal;
            }
        });

        grandTotalElement.innerText = grandTotal.toLocaleString();
        grandTotalInput.value = grandTotal;
    }

    hitungTotal();

    jumlahInputs.forEach(input => {
        input.addEventListener("input", hitungTotal);
    });
});
</script>

@endsection
