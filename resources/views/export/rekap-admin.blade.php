<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Ruas</th>
        <th>KM</th>
        <th>Jalur</th>
        <th>Jenis Kendala</th>
        <th>Nama Agen CSO</th>
        <th>Nama Command Center</th>
        <th>Waktu Forward</th>
        <th>Durasi Created-Forward/th>
        <th>Nama TIC</th>
        <th>Waktu Assign</th>
        <th>Durasi Forward-Assign</th>
        <th>Petugas</th>
        <th>Waktu Petugas Tiba</th>
        <th>Durasi Assign-Petugas Tiba</th>
        <th>Waktu Bantuan Selesai</th>
        <th>Durasi Petugas Tiba - Bantuan Selesai</th>
        <th>Rating Pelanggan</th>
        <th>Ulasan</th>
        <th>Saran Perbaikan</th>
    </tr>
    <?php $x=0; ?>
    @foreach($Laporan as $data)
    <tr>
        <td>{{$x = $x+1}}</td>
        <td>{{$data->laporan_name}}</td>
        <td>{{$data->laporan_phone_no}}</td>
        <td>{{$data->ruas_name}}</td>
        <td>{{$data->laporan_km}}</td>
        <td>{{$data->laporan_jalur}}</td>
        <td>{{$data->kendala}}</td>
        <td>{{$data->cso_id}}</td>
        <td>{{$data->command_center_id}}</td>
        <td>{{$data->laporan_forward_to_tic_timestamp}}</td>
        <td>{{$data->durasi_forward}}</td>
        <td>{{$data->tic_id}}</td>
        <td>{{$data->laporan_forward_to_petugas_timestamp}}</td>
        <td>{{$data->durasi_assign}}</td>
        <td>{{$data->petugas}}</td>
        <td>{{$data->laporan_petugas_arrived_timestamp}}</td>
        <td>{{$data->durasi_arrived}}</td>
        <td>{{$data->laporan_closed_timestamp}}</td>
        <td>{{$data->durasi_done}}</td>
        <td>{{$data->feedback_rate}}</td>
        <td>{{$data->feedback_comment}}</td>
        <td>{{$data->feedback_suggest}}</td>
    </tr>
    @endforeach
</table>