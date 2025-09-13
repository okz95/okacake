@extends('sistem.template.crud_temp')

@section('judul','Okacake - Satuan')

@section('konten')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-8">
    <form action="{{ route('satuan.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
    <div class="card w-100">
      <div class="card-header">
        <div class="card-title mb-2">Tambahkan Data Satuan</div>
        <a href="#" onclick="history.back()">
          <button class="badge badge-secondary" type="button">kembali</button>
        </a>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                <label>Nama Satuan</label>
                <input
                    id="nama"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukan satuan....."
                    value="{{ old('nama') }}"
                    autocomplete="off"
                    required
                />
                @error('nama')
                        <span style="color:red">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-action text-end">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <button class="btn btn-danger" type="reset">Reset</button>
                </div>
            </div>
        </div>   
        </div>
    </div>
    </form>
</div>
</div>
@endsection
