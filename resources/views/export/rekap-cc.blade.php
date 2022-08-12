
<h1>Data Rekapitulasi Permintaan Bantuan</h1>
<table>
    <tr> 
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Ruas</th>
        <th>KM</th>
        <th>Jalur</th>
        <th>Jenis Kendala</th>
        <th>Waktu Pembuatan Laporan</th>
        <th>Nama Agen CSO</th>
        <th>Nama Command Center</th>
        <th>Waktu Forward</th>
        <th>Durasi Created-Forward (menit)</th>
        <th>Nama TIC</th>
        <th>Waktu Assign</th>
        <th>Durasi Forward-Assign (menit)</th>
        <th>Petugas</th>
        <th>Waktu Petugas Tiba</th>
        <th>Durasi Assign-Petugas Tiba (menit)</th>
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
        <td>{{$data->laporan_created_timestamp}}</td>
        <td>{{$data->cso_id_name}}</td>
        <td>{{$data->command_center_id_name}}</td>
        <td>{{$data->laporan_forward_to_tic_timestamp}}</td>
        <td>{{$data->durasi_forward}}</td>
        <td>{{$data->tic_id_name}}</td>
        <td>{{$data->laporan_forward_to_petugas_timestamp}}</td>
        <td>{{$data->durasi_assign}}</td>
        <td>{{$data->petugas}}</td>
        <td>{{$data->laporan_petugas_arrived_timestamp}}</td>
        <td>{{$data->durasi_arrived}}</td>
        <td>{{$data->laporan_closed_timestamp}}</td>
        <td>{{$data->durasi_done}}</td>
    </tr>
    @endforeach
</table>