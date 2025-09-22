@include('sistem.layout.cetak.kop')
 <!-- <div class="jarak">
	
</div> -->
<p class="judul">BUKTI PENGIRIMAN PRODUK</p>
<div class="kiri">
<span>Tanggal Cetak: {{ date('d-m-Y') }}</span>
</div>

@if($transaksi == NULL) 
<div class="isi">
        <center><b>Data Tidak Ditemukan</b></center>
</div>
@endif

    <div class="isi">   
    <table class="he" cellspacing="0" width="100%" border="1px">
  <tr>
    <!-- Kolom pertama: Detail Pengiriman -->
    <td valign="top" width="50%">
      <table class="he" cellspacing="0" width="100%">
        <tr>
          <th colspan="2" bgcolor="yellow">DATA PENGIRIMAN</th>
        </tr>
        <tr>
          <td>ID Pengiriman</td>
          <td>: {{ $transaksi->pengiriman->id }}</td>
        </tr>
        <tr>
          <td>Kurir</td>
          <td>: {{ $transaksi->kurir->profile->nama }} - {{ $transaksi->kurir->profile->no_hp }}</td>
        </tr>
        <tr>
          <td>Status Pengiriman</td>
          <td>: {{ $transaksi->status }}</td>
        </tr>
        {{-- <tr>
          <td>Ongkos Kirim</td>
          <td>: Rp.{{ number_format($transaksi->pengiriman->ongkir) }}</td>
        </tr> --}}
      </table>
    </td>

    <!-- Kolom kedua: Detail Transaksi -->
    <td valign="top" width="50%" border="1px">
      <table class="he" width="100%" >
        <tr>
          <th colspan="4" bgcolor="yellow">DATA TRANSAKSI</th>
        </tr>
        <tr>
          <td>ID Transaksi</td>
          <td colspan="3">: {{ $transaksi->id }}</td>
        </tr>
        <tr>
          <td>Pemesan</td>
          <td>: {{ $transaksi->user->profile->nama }}</td>
          <td>Telepon</td>
          <td>: {{ $transaksi->user->profile->no_hp }}</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td colspan="3">: {{ $transaksi->user->profile->alamat }}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<table id="table">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Jumlah</th>
        <th class="harga">Harga</th>
        <th>Subtotal</th>
    </tr>
    @php $no = 1; @endphp
    @foreach($transaksi->detTemp as $data)
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
        <td colspan="4" class="tr b">Total Pembayaran</td>
        <td class="b">Rp. {{ number_format($transaksi->total) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="tr b">Ongkos Kirim</td>
        <td class="b">Rp. {{ number_format($transaksi->pengiriman->ongkir) }}</td>
    </tr>
    <tr>
        <td colspan="4" class="tr b">Total Pengiriman</td>
        <td id="tot-bayar" class="b"></td>
    </tr>
</table>

<table>
    <tr>
        <th>Penerima</th>
    </tr>
    <tr>
        <td class="tinggi"></td>
    </tr>
    <tr>
        <td>{{ $transaksi->user->profile->nama }}</td>
    </tr>
</table>
</div>
    <script>
        // Ambil angka dari tabel
        const total = parseInt({{ $transaksi->total }});
        const ongkir = parseInt({{ $transaksi->pengiriman->ongkir }});

        // Hitung total pengiriman
        const totalPengiriman = total + ongkir;

        // Format angka ke format Rupiah
        const formatted = totalPengiriman.toLocaleString("id-ID");

        // Tampilkan ke tabel
        document.getElementById("tot-bayar").innerText = "Rp. " + formatted;
    </script>

@include('sistem.layout.cetak.js_cetak')
    </body>
</html>
