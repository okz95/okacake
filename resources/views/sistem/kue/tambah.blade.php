@extends('sistem.template.crud_temp')

@section('judul','Okacake - Kue')

@section('konten')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-8">
    <form action="{{ route('kue.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
    <div class="card w-100">
      <div class="card-header">
        <div class="card-title mb-2">Tambahkan Data Kue</div>
        <a href="#" onclick="history.back()">
          <button class="badge badge-secondary" type="button">kembali</button>
        </a>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nama Kue</label>
                <input
                    id="nama"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nama Kue....."
                    value="{{ old('nama') }}"
                    autocomplete="off"
                />
                @error('nama')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Harga Kue</label>
                <input
                    id="harga"
                    name="harga"
                    type="number"
                    class="form-control"
                    placeholder="Masukan Harga Kue....."
                    value="{{ old('harga') }}"
                />
                @error('harga')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Kategori</label>
                          <select
                            class="form-select"
                            name = "kategori"
                            id="kategori"
                            value="{{ old('kategori') }}"
                          >
                            <option>-- Pilih Kategori -- </option>
                            @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                            </option>
                            @endforeach
                          </select>
                          @error('kategori')
                            <span style="color:red">{{ $message }}</span>
                          @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Satuan</label>
                          <select
                            class="form-select"
                            name = "satuan"
                            id="satuan"
                            value="{{ old('satuan') }}"
                          >
                            <option>-- Pilih Satuan -- </option>
                            @foreach($satuan as $sat)
                            <option value="{{ $sat->id }}" {{ old('satuan') == $sat->id ? 'selected' : '' }}>
                            {{ $sat->nama }}
                            @endforeach
                          </select>
                          @error('satuan')
                        <span style="color:red">{{ $message }}</span>
                          @enderror
                    </div>
                </div>
                <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Stok</label>
                <input
                    id="stok"
                    name="stok"
                    type="number"
                    class="form-control"
                    placeholder="Masukan Stok....."
                    value="{{ old('stok') }}"
                />
                @error('stok')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label for="exampleFormControlFile1">Upload Foto kue</label>
                          <input
                            type="file"
                            class="form-control-file"
                            id="foto"
                            name="foto"
                            onchange="previewFoto(event)"
                          />
                          @error('foto')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <img id="preview" src="#" alt="Preview Foto Kue" style="max-width: 400px; display: none; margin: 20px auto" />
            </div>
        </div>
                
        </div>
        <div class="row">
            <div class="card-action text-end">
                <button class="btn btn-success" type="submit">Simpan</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </div>
    </div>
    </div>
    </form>
</div>
</div>
@endsection
