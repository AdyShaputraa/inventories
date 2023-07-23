@extends('layouts.main')
@section('content')
<main id="main" class="main">
  <section class="section">
    <div class="row">
        <div class="card text-white bg-flat-color-1">
          <div class="text-start mt-4 mb-4 fw-bold">
            <i class="fa-solid fa-truck text-purple"></i>&nbsp;
            <span class="fw-bold text-muted mr-4">Data Barang</span>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-lg-6">
                <div class="card text-white bg-flat-color-1">
                  <div class="card-body pb-0">
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="text-black fw-bold d-flex align-items-center" style="background-color: #EEF4FF; padding: 5px; margin-bottom: 5px; width: fit-content;">
                          <i class="bi bi-box" style="font-size: 2.5rem; margin-right: 8px;"></i>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col">
                            <div class="text-black fw-bold">
                              <span style="font-size: 20px;  margin-left: 8px;">Total Barang</span>
                            </div>
                            <div class="text-black fw-bold">
                              <span style="font-size: 20px;  margin-left: 8px;"> {{ $totalBarang }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6 col-lg-6">
                <div class="card text-white bg-flat-color-1">
                  <div class="card-body pb-0">
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="text-black fw-bold d-flex align-items-center" style="background-color: #EEF4FF; padding: 5px; margin-bottom: 5px; width: fit-content;">
                          <i class="bi bi-exclamation-triangle" style="font-size: 2.5rem; margin-right: 8px;"></i>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col">
                            <div class="text-black fw-bold">
                              <span style="font-size: 20px;  margin-left: 8px;">Total Barang Rusak</span>
                            </div>
                            <div class="text-black fw-bold">
                              <span style="font-size: 20px;  margin-left: 8px;">{{ $totalKerusakan }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row g-2">
              <div class="col-8">
                <div class="border rounded bg-light">
                  <form action="/barang" class="search-form d-flex align-items-center">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Cari Nama Barang / No STTB / Serial Number / Kode Barang" name="search" value="{{ request('search') }}">
                      <button type="submit" class="btn text-start" style="border: none !important;">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-1">
                <div class="border rounded bg-light">
                  <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#importBarang">
                    Import
                  </button>
                </div>
              </div>
              <div class="col-1">
                <div class="border rounded bg-light">
                  <a href="/barang/exportexcel" target="_blank">
                    <button type="button" class="btn btn-success w-100">Export</button>
                  </a>
                </div>
              </div>
              <div class="col-2">
                <div class="border rounded bg-light">
                  <button type="button" class="btn btn-purple w-100" data-bs-toggle="modal" data-bs-target="#createBarang">
                    Tambah Barang
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="container mt-4">
            <div class="row">
              @if (session()->has('success'))
              <br>
                <div class="alert alert-success" role="alert">
                  {{ session('success') }}
                </div>
              <br>
              @endif

              @if ($errors->any())
              <br>
                <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                  {{ $error }}
                  @endforeach
                </div>
              <br>
              @endif

              @if (Session::has('import_errors'))
              <br>
                <div class="alert alert-danger" role="alert">
                  @foreach (Session::get('import_errors') as $failure)
                  {{ $failure->errors()[0] }} at line no-{{ $failure->row() }}
                  @endforeach
                </div>
              <br>
              @endif

              <div class="table-responsive">
                <table class="table table-hover table-sm align-middle nowrap">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Pemilik</th>
                      <th class="text-center">Nama Barang</th>
                      <th class="text-center">Serial Number</th>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Gudang</th>
                      <th class="text-center col-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($barang as $i => $b)
                      <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="text-center">{{ $b->nama_pemilik }}</td>
                        <td class="text-center">{{ $b->nama_barang }}</td>
                        <td class="text-center">{{ $b->serial_number }}</td>
                        <td class="text-center">{{ $b->jumlah }}&nbsp;{{ $b->satuan }}</td>
                        <td class="text-center">{{ $b->lokasi_barang }}</td>
                        <td>
                          <div class="text-center">
                            <form action="{{ url('barang/'.$b->id) }}" method="POST">
                              <button type="button" class="btn btn-sm btn-purple" data-bs-toggle="modal" data-bs-target="#lihatBarang{{ $b->id }}">
                                <i class=" bi bi-eye"></i>
                              </button>
                              
                              <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBarangs{{ $b->id }}">
                                <i class=" bi bi-pencil-square"></i>
                              </button>

                              @csrf 
                              <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are You Sure')">
                                <i class="bi bi-trash"></i>
                              </button>
                              <input type="hidden" name="_method" value="DELETE">
                            </form>
                          </div>

                          <div class="modal fade" id="editBarangs{{ $b->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Barang</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  @include('barang.edit_barang')
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal fade" id="lihatBarang{{ $b->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel{{ $b->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Detail Barang</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  @include('barang.lihat_barang')
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>
  
  <div class="modal fade" id="createBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @include('barang.create_barang')
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="importBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Import Data Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/barang/importexcel" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label>File</label>
              <input type="file" name="file" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col-12">
              <div class="row">
                <div class="col-6"><button type="button" class="btn btn-outline-purple w-100" data-bs-dismiss="modal">Batal</button></div>
                <div class="col-6"><button type="submit" class="btn btn-purple w-100">Import</button></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection
