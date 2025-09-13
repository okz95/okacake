@extends('sistem.template.sistem_temp')

@section('judul','Okacake - Profile')

@section('konten')
    <div class="container">
          <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Profil Pengguna</h4>
                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-primary">
                        <i class="fas fa-pen-square"></i>
                        Ubah</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $data->nama }}</td>
                        <td rowspan="3">
                            <img src="{{ asset($data->foto) }}" alt="Foto Profil" height="150px">
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{ $data->alamat }}</td>
                      </tr>
                      <tr>
                        <td>Nomor Hand Phone</td>
                        <td>{{ $data->no_hp }}</td>
                      </tr>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection
        