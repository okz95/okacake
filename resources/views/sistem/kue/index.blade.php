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
                                      <td>
                                        <a href="{{ route('kue.edit', $data ) }}" style="margin-left : 0.1px" title="Ubah" class="d-inline-block">
                                          <span class="badge badge-primary">
                                            <i class="fas fa-pen-square"></i>
                                          </span>
                                        </a>

                                        <a href="#" style="margin-left : 0.1px" title="Lihat" data-bs-toggle="modal" data-bs-target="#lihat{{ $data->id }}" class="d-inline-block">
                                          <span class="badge badge-success">
                                            <i class="far fa-eye"></i>
                                          </span>
                                        </a>

                                        <a href="{{ route('kue.destroy', $data->id ) }}" style="margin-left : 0.1px" title="Hapus" class="d-inline-block" data-confirm-delete="true">
                                          <span class="badge badge-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </a>
                                      </td>
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
         @if ($kue != NULL)
        @foreach ($kue as $data)
          <!-- Modal -->
          <div class="modal fade" id="lihat{{ $data->id }}" tabindex="-1" aria-labelledby="lihatLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="lihatLabel{{ $data->id }}">Detail Kue</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                  <div class="card-body">
                    <table class="table table-bordered">
                      <tr>
                          <td colspan="2" class="text-center" style="background-color: gray;">
                            <img 
                            src="{{ asset($data->foto) }}" 
                            alt="{{ $data->foto }}"
                            height="200px">
                          </td>
                        </tr>
                        <tr>
                          <td>Nama Kue</td>
                          <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                          <td>Kategori</td>
                          <td>{{ $data->kategori->nama }}</td>
                        </tr>
                        <tr>
                          <td>Stok</td>
                          <td>{{ $data->stok }} {{ $data->satuan->nama }}</td>
                        </tr>
                        <tr>
                          <td>Harga</td>
                          <td>{{ $data->harga }}</td>
                        </tr>
                    </table>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        @endif
@endsection
        