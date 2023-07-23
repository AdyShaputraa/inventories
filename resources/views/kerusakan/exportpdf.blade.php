
    <h1>Data Kerusakan Barang</h1>
    
      <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm8">
          <thead>
            <tr>
                <th>No</th>
                {{-- <th>Image</th> --}}
                <th>Nama Barang</th>
                <th>Serial Number</th>
                <th>Kode Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Keterangan Kerusakan</th>
                <th>Status</th>
                <th>Penerima/Pengirim</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($Kerusakan as $i => $k )
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $k->barang->nama_barang }}</td>
                <td>{{ $k->barang->serial_number }}</td>
                <td>{{ $k->barang->kode_barang}}</td>
                <td>{{ $k->tanggal }}</td>
                <td>{{ $k->jumlah_rusak}}</td>
                <td>{{ $k->barang->satuan }}</td>
                <td>{{ $k->kerusakan_barang }}</td>
                <td>{{ $k->status }}</td>
                <td>{{ $k->nama_penerima }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>