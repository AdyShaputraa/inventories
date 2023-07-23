
<h1>Data  User</h1>
    
<div class="table-responsive col-lg-8">
  <table class="table table-striped table-sm8">
    <thead>
      <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>No Whatapp</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($User as $i => $u )
      <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $u->nama_lengkap }}</td>
          <td>{{ $u->username }}</td>
          <td>{{ $u->no_hp}}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->role }}</td>
          <td>{{ $u->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>