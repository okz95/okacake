@extends('sistem.template.sistem_temp')

@section('judul','Okacake - Toko')

@section('konten')
    <div class="container">
          <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Profil Toko</h4>
                    <a href="{{ route('toko.edit') }}" class="btn btn-primary">
                        <i class="fas fa-pen-square"></i>
                        Ubah</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <td>Nama Toko</td>
                        <td>{{ $data->nama }}</td>
                        <td rowspan="3" class="text-center">
                            <img src="{{ asset($data->logo) }}" alt="Logo Toko" height="150px">
                        </td>
                      </tr>
                      <tr>
                        <td>Pemilik</td>
                        <td>{{ $data->pemilik }}</td> 
                      </tr>
                      <tr>
                        <td>Nomor Hand Phone</td>
                        <td colspan="2">{{ $data->no_hp }}</td>
                      </tr>
                      <tr>
                        <td>Nomor Fax</td>
                        <td colspan="2">{{ $data->fax }}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td colspan="2">{{ $data->alamat }}, {{ $data->kota }}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td colspan="2">{{ $data->email }}</td>
                      </tr>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection
        