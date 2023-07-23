@extends('layouts.main')
@section('content')
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="text-start mt-4 mb-4 fw-bold">
          <i class="fa-solid fa-triangle-exclamation text-purple"></i>&nbsp;
          <span class="fw-bold text-muted mr-4">Kerusakan Barang</span>
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
                            <span style="font-size: 20px;  margin-left: 8px;">Barang Yang Selesai</span>
                          </div>
                          <div class="text-black fw-bold">
                            <span style="font-size: 20px;  margin-left: 8px;"> {{ $totalSelesai }}</span>
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
                            <span style="font-size: 20px; margin-left: 8px;">Sedang Di Service</span>
                          </div>
                          <div class="text-black fw-bold">
                            <span style="font-size: 20px; margin-left: 8px;">{{ $totalService }}</span>
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
                    <input type="text" class="form-control" placeholder="Cari Nama Barang" name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn text-start" style="border: none !important;">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-1">
              <div class="border rounded bg-light">
                <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#filterkerusakan">
                  Filter
                </button>
              </div>
            </div>
            <div class="col-1">
              <div class="border rounded bg-light">
                <a href="/kerusakan/exportexcel" target="_blank">
                  <button type="button" class="btn btn-success w-100">Export</button>
                </a>
              </div>
            </div>
            <div class="col-2">
              <div class="border rounded bg-light">
                <a href="/kerusakan/create">
                  <button type="button" class="btn btn-purple w-100">Tambah Barang</button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="container mt-4">
          <div class="row">
            <!-- <div class="table-responsive"> -->
              <table class="table table-hover table-sm align-middle nowrap">
                <thead class="table-dark">
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Nama Pemilik</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Kerusakan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kerusakan as $i => $k)
                    <tr>
                      <td class="text-center">{{ $i + 1 }}</td>
                      <td class="text-center">{{ $k->updated_at }}</td>
                      <td class="text-center">{{ $k->barang->nama_barang }}</td>
                      <td class="text-center">{{ $k->barang->nama_pemilik }}</td>
                      <td class="text-center">{{ $k->jumlah_rusak }}&nbsp;{{ $k->barang->satuan }}</td>
                      <td class="text-center">{{ $k->kerusakan_barang }}</td>
                      <td class="text-center">
                        @if ($k->status == "Selesai") <span class="badge badge-success text-bg-success fw-bold">Selesai</span>
                        @elseif ($k->status == "Service") <span class="badge badge-warning text-bg-danger fw-bold">Service</span>
                        @elseif ($k->status == "Diterima") <span class="badge badge-primary text-bg-primary fw-bold">Diterima</span>
                        @elseif ($k->status == "Serahkan") <span class="badge badge-danger text-bg-danger fw-bold">Serahkan</span>
                        @endif
                      </td>
                      <td>
                        <div class="text-center">
                          <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}">
                            <i class="fa-solid fa-arrows-rotate" style="color: white"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-purple" data-bs-toggle="modal" data-bs-target="#history{{ $k->id }}">
                            <i class="fa-solid fa-clock-rotate-left" style="color: white"></i>
                          </button>
                          <div class="btn-group">
                            <button class="btn btn-sm" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <li>
                                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#editKerusakan{{ $k->id }}">Edit</button>
                              </li>
                              <li>
                                <form action="{{ url('kerusakan/'.$k->id) }}" method="POST">
                                  @csrf 
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button class="dropdown-item" type="button" type="submit" onclick="return confirm('Are You Sure')">Hapus</button>
                                </form>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $k->id }}Label" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Update Status Kerusakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="alert alert-info d-flex flex-row" role="alert">
                                  <div class="row">
                                    <div class="col-auto align-self-center">
                                      <i class="fa-solid fa-circle-info fa-2xl"></i>
                                    </div>
                                    <div class="col">
                                      <h >Update Status secara berkala dari mulai diterima hinggal barang telah diambil</h>
                                    </div>
                                  </div>
                                </div>
                                
                                <form action="/kerusakan/{{ $k->id }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="form-group mb-3">
                                    <label class="text-start">Status </label><small class="text-danger"> *</small>
                                    <div class="alert alert-secondary" role="alert">
                                      <div class="container">
                                        <div class="row input-group text-center">
                                          <div class="col">
                                            <input type="radio" name="status" class="btn-check" ids="{{ $k->id }}" id="Service{{ $k->id }}" value="Service" {{ old('status', $k->status) == 'Service' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-purple w-100" for="Service{{ $k->id }}">Service</label>
                                          </div>
                                          <div class="col">
                                            <input type="radio" name="status" class="btn-check" ids="{{ $k->id }}" id="Selesai{{ $k->id }}" value="Selesai" {{ old('status', $k->status) == 'Selesai' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-purple w-100" for="Selesai{{ $k->id }}">Selesai</label>
                                          </div>
                                          <div class="col">
                                            <input type="radio" name="status" class="btn-check" ids="{{ $k->id }}" id="Serahkan{{ $k->id }}" value="Serahkan" {{ old('status', $k->status) == 'Serahkan' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-purple w-100" for="Serahkan{{ $k->id }}">Serahkan</label>
                                          </div>
                                        </div>
                                        @error('status')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>
                                  <div id="input1{{ $k->id }}" class="form-group" style="display: none;">
                                    <label class="text-start mt-2" >Di Service Oleh? </label><small class="text-danger"> *</small>
                                    <input type="text" name="nama_penyervice" class="form-control @error('nama_penyervice') is-invalid @enderror" placeholder="Masukan nama tempat service"  required value="{{  $k->nama_penyervice }}">
                                    @error('nama_penyervice')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>  
                                    @enderror
                                  </div>
                                  <div id="input2{{ $k->id }}" class="form-group" style="display: none;">
                                    <label class="text-start" >Catatan (Optional)</label>
                                    <textarea class="form-control @error('catatan_selesai') is-invalid @enderror" rows="4" cols="50" placeholder="Masukan catatan apabila ada catatan" type="text" name = 'catatan_selesai' required> {{ old('catatan_selesai', $k->catatan_selesai) }} </textarea>
                                    @error('catatan_selesai')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div id="input3{{ $k->id }}" style="display: none;">
                                    <div class="form-group">
                                      <label class="text-start">Diserahkan Kepada </label><small class="text-danger"> *</small>
                                      <input type="text" name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror" placeholder="Masukan nama pemilik barang"  required value="{{  $k->nama_penerima }}">
                                      @error('nama_penerima')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>  
                                      @enderror
                                    </div>
                                    <div class="form-group">
                                      <label class="text-start" >Catatan (Optional)</label>
                                      <textarea class="form-control @error('catatan_selesai') is-invalid @enderror" rows="4" cols="50" placeholder="Masukan catatan apabila ada catatan" type="text" name = 'catatan_selesai' required> {{ old('catatan_selesai', $k->catatan_selesai) }} </textarea>
                                      @error('catatan_selesai')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-3">
                                    <div class="row">
                                      <div class="col-6">
                                        <a href="/kerusakan">
                                          <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                                        </a>
                                      </div>
                                      <div class="col-6"><button type="submit" class="btn btn-purple w-100">Simpan</button></div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="modal fade" id="history{{ $k->id }}" tabindex="-1"  role="dialog" aria-labelledby="history{{ $k->id }}Label" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                @include('kerusakan.history_kerusakan', ['activities' => $activities, 'activityId' => $k->id])
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="editKerusakan{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="editKerusakan{{ $k->id }}Label" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editKerusakan{{ $k->id }}Label">Edit Kerusakan Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                @include('kerusakan.edit_kerusakan')
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="filterkerusakan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/kerusakan/filter" method="GET">
          <div class="modal-body">
            <div class="form-group">
              <label>Status</label>
              <select name="status" id="status" class="form-control" required>
                <option selected disabled value>Semua Status</option>
                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Service" {{ request('status') == 'Service' ? 'selected' : '' }}>Service</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Serahkan" {{ request('status') == 'Serahkan' ? 'selected' : '' }}>Serahkan</option>
              </select>
            </div>
            <div class="col-12 mt-3">
              <div class="row">
                <div class="col-6">
                  <a href="/kerusakan">
                    <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                  </a>
                </div>
                <div class="col-6"><button type="submit" class="btn btn-purple w-100">Submit</button></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-check').change(function() {
      var selectedOption = $(this).attr('id');
      var select = $(this).attr('ids');
      $('[id^="input"]').hide();

      if (selectedOption === 'Service' + select) {
        $('#input1' + select).show();
      } else if (selectedOption === 'Selesai' + select) {
        $('#input2' + select).show();
      } else if (selectedOption === 'Serahkan' + select) {
        $('#input3' + select).show();
      }
    });

  });
</script>
@endsection

