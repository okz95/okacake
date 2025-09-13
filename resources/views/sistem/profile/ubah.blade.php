@extends('sistem.template.crud_temp')

@section('judul','Okacake - Profile')

@section('konten')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-8">
    <form action="{{ route('profile.update', $data) }}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
    <div class="card w-100">
      <div class="card-header">
        <div class="card-title mb-2">Ubah Data Pengguna</div>
        <a href="#" onclick="history.back()">
          <button class="badge badge-secondary" type="button">kembali</button>
        </a>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nama Pengguna</label>
                <input
                    id="nama"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Nama Pengguna....."
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
                <label>Nomor Hand Phone</label>
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Alamat</label>
                <input
                    id="alamat"
                    name="alamat"
                    type="text"
                    class="form-control"
                    placeholder="Masukan Alamat Pengguna....."
                    value="{{ old('alamat', $data->alamat) }}"
                />
                @error('alamat')
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
              <img 
                  id="preview" 
                  src="{{ $data->foto ? asset($data->foto) : '#' }}" 
                  alt="Preview Foto Kue" 
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
