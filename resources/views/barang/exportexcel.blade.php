<div class="table-responsive col-lg-8">
  <table class="table table-striped table-sm8">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pemilik</th>
        <th>Nama Barang</th>
        <th>Serial Number</th>
        <th>Kode Barang</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Satuan</th>
        <th>Lokasi Barang</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barang as $i => $b )
      <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $b->nama_pemilik }}</td>
          <td>{{ $b->nama_barang }}</td>
          <td>{{ $b->serial_number }}</td>
          <td>{{ $b->kode_barang}}</td>
          <td>{{ $b->tanggal_terima }}</td>
          <td>{{ $b->jumlah }}</td>
          <td>{{ $b->satuan }}</td>
          <td>{{ $b->lokasi_barang }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>