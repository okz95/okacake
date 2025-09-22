@extends('sistem.template.crud_temp')

@section('judul','Okacake - Profile')

@section('konten')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-8">
    <form action="{{ route('toko.update') }}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
    <div class="card w-100">
      <div class="card-header">
        <div class="card-title mb-2">Ubah Data Toko</div>
        <a href="#" onclick="history.back()">
          <button class="badge badge-secondary" type="button">kembali</button>
        </a>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nama Toko</label>
                <input
                    id="nama"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nama Toko....."
                    value="{{ old('nama', $data->nama) }}"
                    autocomplete="off"
                />
                @error('nama')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nama Pemilik</label>
                <input
                    id="pemilik"
                    name="pemilik"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nama Pemilik"
                    value="{{ old('pemilik', $data->pemilik) }}"
                />
                @error('pemilik')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nomor Handphone</label>
                <input
                    id="no_hp"
                    name="no_hp"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nomor HP....."
                    value="{{ old('no_hp', $data->no_hp) }}"
                />
                @error('no_hp')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nomor Fax</label>
                <input
                    id="fax"
                    name="fax"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nomor Fax"
                    value="{{ old('fax', $data->fax) }}"
                />
                @error('fax')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                <label>Alamat Toko</label>
                <input
                    id="alamat"
                    name="alamat"
                    type="text"
                    class="form-control"
                    placeholder="Masukan alamat Toko....."
                    value="{{ old('alamat', $data->alamat) }}"
                    autocomplete="off"
                />
                @error('alamat')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Kota</label>
                <input
                    id="kota"
                    name="kota"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Kota....."
                    value="{{ old('kota', $data->kota) }}"
                    autocomplete="off"
                />
                @error('nama')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Email</label>
                <input
                    id="email"
                    name="email"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nama email"
                    value="{{ old('email', $data->email) }}"
                />
                @error('email')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="exampleFormControlFile1">Upload Logo Toko</label>
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
              <img 
                  id="preview" 
                  src="{{ $data->foto ? asset($data->foto) : '#' }}" 
                  alt="Preview Logo Toko" 
                  style="max-height: 200px; {{ $data->foto ? '' : 'display:none;' }} margin: 20px auto" 
              />
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
