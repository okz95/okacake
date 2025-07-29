@extends('sistem.template.sistem_temp')

@section('judul','Okacake - Kue')

@section('konten')
    <div class="container">
          <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Kue</h4>
                    <a href="{{ route('kue.create') }}" class="btn btn-primary">Tambah</a>
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
                            <th>Nama Kue</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>Nama Kue</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @if ($kue->isEmpty())
                              <tr>
                                  <td colspan="4" class="text-center"><b>Data Tidak Ditemukan!</b></td>
                              </tr>
                          @else
                              @foreach ($kue as $data)
                                  <tr>
                                      <td></td>
                                      <td>{{ $data->nama }}</td>
                                      <td>{{ $data->kategori->nama }}</td> 
                                      <td>{{ $data->stok }} {{ $data->satuan->nama }}</td>
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
@endsection
        