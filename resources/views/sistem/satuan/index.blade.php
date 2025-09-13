@extends('sistem.template.sistem_temp')

@section('judul','Okacake - Satuan')

@section('konten')
    <div class="container">
          <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Satuan</h4>
                    <a href="{{ route('satuan.create') }}" class="btn btn-primary">Tambah</a>
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
                            <th>Nama satuan</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>Nama satuan</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @if ($satuan->isEmpty())
                              <tr>
                                  <td colspan="4" class="text-center"><b>Data Tidak Ditemukan!</b></td>
                              </tr>
                          @else
                              @foreach ($satuan as $data)
                                  <tr>
                                      <td>
                                        <a href="{{ route('satuan.destroy', $data->id ) }}" style="margin-left : 0.1px" title="Hapus" class="d-inline-block" data-confirm-delete="true">
                                          <span class="badge badge-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </a>
                                      </td>
                                      <td>{{ $data->nama }}</td>
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
        