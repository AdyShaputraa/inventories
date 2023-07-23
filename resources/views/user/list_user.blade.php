@extends('layouts.main')
@section('content')
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="text-start mt-4 mb-4 fw-bold">
          <i class="fa-solid fa-user text-purple"></i>&nbsp;
          <span class="fw-bold text-muted mr-4">User Account</span>
        </div>

        <div class="container">
          <div class="row g-2">
            <div class="col-7">
              <div class="border rounded bg-light">
                <form action="/user" class="search-form d-flex align-items-center">
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
                <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#staticBack">
                  Filter
                </button>
              </div>
            </div>
            <div class="col-1">
              <div class="border rounded bg-light">
                <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Import
                </button>
              </div>
            </div>
            <div class="col-1">
              <div class="border rounded bg-light">
                <a href="/user/exportexcel" target="_blank">
                  <button type="button" class="btn btn-success w-100">Export</button>
                </a>
              </div>
            </div>
            <div class="col-2">
              <div class="border rounded bg-light">
                <button type="button" class="btn btn-purple w-100" data-bs-toggle="modal" data-bs-target="#createUser">
                  Tambah
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
                @foreach (Session::get('import_errors') as $failure)
                <div class="alert alert-danger" role="alert">
                  {{ $failure->errors()[0] }} at line no-{{ $failure->row() }}
                </div>
                @endforeach
              <br>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle nowrap">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Lengkap</th>
                      <th class="text-center">Username</th>
                      <th class="text-center">Role</th>
                      <th class="text-center">Status</th>
                      <th class="text-center col-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $i => $u)
                      <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="text-center">{{ $u->nama_lengkap }}</td>
                        <td class="text-center">{{ $u->username }}</td>
                        <td class="text-center">{{ $u->role }}</td>
                        <td class="text-center">
                          @if ($u->status == 1) <span class="badge badge-success text-bg-success fw-bold">Aktif</span>
                          @elseif ($u->status == 0) <span class="badge badge-warning text-bg-danger fw-bold">Tidak Aktif</span>
                          @endif
                        </td>
                        <td>
                          <div class="text-center">
                            <form action="{{ url('user/'.$u->id) }}" method="POST">
                              <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUser{{ $u->id }}">
                                <i class=" bi bi-pencil-square"></i>
                              </button>
                              @csrf 
                              <input type="hidden" name="_method" value="DELETE">
                              <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are You Sure')"><i class="bi bi-trash"></i></button>
                            </form>
                          </div>

                          <div class="modal fade editUser" id="editUser{{ $u->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit User</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  @include('user.edit_user')
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
  
  <div class="modal fade" id="staticBack" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form action="/user/filter" method="GET" >
          <div class="modal-body">
            <div class="form-group">
              <label>Status</label>
              <select name="status" id="status" class="form-control" required>
                <option selected disabled value>Semua Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
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

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import Users</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/user/importexcel" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label>File</label>
              <input type="file" name="file" class="form-control" required>
            </div>
            <div class="col-12 mt-3">
              <div class="row">
                <div class="col-6">
                  <a href="/kerusakan">
                    <button type="button" class="btn btn-outline-purple w-100">Batal</button>
                  </a>
                </div>
                <div class="col-6"><button type="submit" class="btn btn-purple w-100">Import</button></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="createUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createUserLabel">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @include('User.create_user')
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('button[data-toggle="modal"]').click(function() {
      var targetModal = $(this).data('target');
      $(targetModal).modal('show');
    });

    $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
    });

    $('#filter-form').submit(function(e) {
      e.preventDefault();

      var status = $('#status').val();
      $.ajax({
        url: $(this).attr('action'),
        type: 'GET',
        data: { status: status },
        success: function(response) {
          $('#user-table').html(response);
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('editUser');
    var radioButtons = modal.querySelectorAll('input[name="status"]');
  
    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        radioButtons.forEach(function(radio) {
          var label = radio.nextElementSibling;
          label.classList.remove('active-hover');
        });
  
        if (this.checked) {
          var label = this.nextElementSibling;
          label.classList.add('active-hover');
        }
      });
    });
  });
</script>
@endsection
