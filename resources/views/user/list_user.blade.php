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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import Users</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/user/importexcel" method="POST" enctype="multipart/form-data" class="form-upload">
          @csrf
          <div class="modal-body">
            <span class="text-muted">Upload template excel pada form dibawah ini</span>
            <div class="form-group mt-4">
              <span class="text-muted">Sebelum import pastikan download template import dibawah ini terlebih dahulu</span>
              <a href="/user/exportexcel">
                <button class="btn btn-purple w-100">Download Template Import</button>
              </a>
            </div>
            <div class="form-group mt-3">
              <div class="row">
                <div style="margin: auto; width: 100%; text-align: center;">
                  <div style="background-color: #f5e1f7; border-radius: 10px; border: 3px dashed rgba(226, 10, 247, 0.65);">
                    <div style="background-color: rgb(245, 225, 247); border-radius: 10px; padding: 10px;">
                      <div class="drag-file">
                        <div class="import-logo-image">
                          <img class="navbar-brand" src="/images/frame.png" alt="Logo"><br>
                        </div>
                        <div class="progress-custom mx-auto mt-2" datavalue="0">
                          <span class="progress-left">
                            <span class="progress-bar-custom border-purple"></span>
                          </span>
                          <span class="progress-right">
                            <span class="progress-bar-custom border-purple"></span>
                          </span>
                          <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                            <div class="h2 font-weight-bold percent-text"></div>
                          </div>
                        </div>
                        <div class="message-upload mt-2">
                          <div class="row">
                            <div class="col-3 text-end">
                              <img class="navbar-brand" src="/images/file.png" alt="Logo File">
                            </div>
                            <div class="col-9 text-start">
                              <div class="mt-5">
                                <span class="file-name-label align-middle fw-bold"></span><br>
                                <button type="button" class="btn btn-xs btn-danger btn-clear-file">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <input type="file" name="file" class="form-control-file" id="file-import-users" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required style="visibility: hidden"><br>
                        <label class="drag-file-text" for="file-import-users" id="file-import-users-label"><b>Drag File Disini</b> <br> atau klik area ini dan pilih File</label><br><br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <span style="color: red">Pastikan header table tidak dirubah, format penulisan disesuaikan dengan template</span>
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

    $('.btn-active-edit-user').hide();
    $('.btn-active-edit-user').on('change', function() {
      var id = $(this).attr('data-id');
      $('#label-edit-input-not-active'+ id + ', #label-edit-input-active' + id).addClass("btn-outline-purple");
      if ($(this).val() == 1) {
        $("#edit-input-active" + id).prop("checked", true);
        $('#label-edit-input-active' + id).removeClass("btn-outline-purple");
        $('#label-edit-input-active' + id).addClass("btn-purple");
        $('#label-edit-input-not-active' + id).removeClass("btn-purple");
      } else {
        $("#edit-input-not-active" + id).prop("checked", true);
        $('#label-edit-input-not-active' + id).removeClass("btn-outline-purple");
        $('#label-edit-input-not-active' + id).addClass("btn-purple");
        $('#label-edit-input-active' + id).removeClass("btn-purple");
      }
    });

    $('.progress-custom, .message-upload').hide(); $('.percent-text').html('0%');
    $('.form-control-file').on('change', function() {
      $('.import-logo-image').hide(); $('.progress-custom').show();
      var file = document.getElementById('file-import-users').files[0];
      if (file == '') {
        alert('Please select the file');
        return false;
      } else {
        var data = new FormData();
        data.append("file", file);
        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();         
            xhr.upload.addEventListener("progress", function(element) {
              if (element.lengthComputable) {
                var percentComplete = ((element.loaded / element.total) * 100);
                $('.progress-custom').attr('datavalue', Math.round(percentComplete));
                $('.percent-text').html(Math.round(percentComplete) + '%');
                $(".progress-custom").each(function() {
                  var left = $(this).find('.progress-left .progress-bar-custom');
                  var right = $(this).find('.progress-right .progress-bar-custom');
                  if (percentComplete > 0) {
                    if (percentComplete <= 50) {
                      right.css('transform', 'rotate(' + percentageToDegrees(percentComplete) + 'deg)');
                    } else {
                      right.css('transform', 'rotate(180deg)');
                      left.css('transform', 'rotate(' + percentageToDegrees(percentComplete - 50) + 'deg)');
                    }
                  }
                });
              }
            }, false);
            return xhr;
          },
          url: '/user/upload',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          beforeSend: function() {
            $('progress-custom').data('value', 0);
          },
          success: function (data) {
            $('.progress-custom, .file-import-users, .drag-file-text').hide();
            $('.message-upload').show();
            $('.file-name-label').html(file.name);
          }
        });
      }
    });

    $('.btn-clear-file').on('click', function() {
      $('.form-control-file').val('');
      $('.progress-custom, .message-upload').hide();
      $('.import-logo-image, .file-import-users, .drag-file-text').show();
    });
  });
  
  function percentageToDegrees(percentage) {
    return percentage / 100 * 360
  }
</script>
@endsection
