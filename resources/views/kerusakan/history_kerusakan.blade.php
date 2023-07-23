@php $data = array(); @endphp
@foreach ($k->activities->reverse() as $index => $a)
@php
    $barangId = json_decode($a->properties)->attributes->barang_id;
    $barang = $barang->firstWhere('id', $barangId);
    $status = json_decode($a->properties)->attributes->status;

    array_push($data, array(
        'barang' => $barang->nama_barang,
        'kerusakan_barang' => json_decode($a->properties)->attributes->kerusakan_barang,
        'catatan_service' => json_decode($a->properties)->attributes->catatan_service,
        'catatan_selesai' => json_decode($a->properties)->attributes->catatan_selesai,
        'catatan_serahkan' => json_decode($a->properties)->attributes->catatan_serahkan,
        'nama_penerima' => json_decode($a->properties)->attributes->nama_penerima,
        'status' => $status,
        'datetime' => $a->created_at
    ));
@endphp
@endforeach

<ul class="history-tracking">
    @if (!empty($data[3]))
    <li>
        <p>
            <div class="row">
                <div class="mr-2">
                    Laporan Kerusakan Ditutup
                </div>
            </div>
        </p>
    </li>
    @endif
    @if (!empty($data[2]))
    <li>
        <p>
            Barang <span class="fw-bold">{{ $data[2]['barang'] }}</span> Barang sudah diserahkan kepada <span class="fw-bold">{{ $data[2]['nama_penerima'] }}</span>
            <br>
            Catatan : <span class="text-muted">{{ $data[2]['catatan_serahkan'] }}</span>
            <br><span class="text-muted">{{ $data[2]['datetime'] }}</span>
        </p>
    </li>
    @endif
    @if (!empty($data[1]))
    <li>
        <p>
            Barang <span class="fw-bold">{{ $data[1]['barang'] }}</span> sedang diservice oleh <span class="fw-bold">{{ $data[1]['nama_penerima'] }}</span>
            <br>
            Catatan : <span class="text-muted">{{ $data[1]['catatan_service'] }}</span>
            <br><span class="text-muted">{{ $data[1]['datetime'] }}</span>
        </p>
    </li>
    @endif
    @if (!empty($data[0]))
    <li>
        <p>
            Barang <span class="fw-bold">{{ $data[0]['barang'] }}</span> telah diterima oleh <span class="fw-bold">{{ $data[0]['nama_penerima'] }}</span>
            <br>
            Catatan : <span class="text-muted">{{ $data[0]['kerusakan_barang'] }}</span>
            <br><span class="text-muted">{{ $data[0]['datetime'] }}</span>
        </p>
    </li>
    @endif
</ul>
