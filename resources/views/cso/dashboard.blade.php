@extends('master')
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
									<div class="row">
                                        <button type="button" class="btn btn-primary">+ Tambah Data</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="table" class="table table-no-bordered">
                                            <thead style="color:white">
                                                <tr>
                                                    <th>Waktu Laporan</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Ruas</th>
                                                    <th>Jalur</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color:white">
                                                <tr style="background-color:#370c4a">
                                                    <td>07.52 WIB 25/05/22</td>
                                                    <td>Sutrisna</td>
                                                    <td>0821931313</td>
                                                    <td>Honda Jazz</td>
                                                    <td>B 8172 WQ</td>
                                                    <td>Jagorawi</td>
                                                    <td>A</td>
                                                    <td>Pecah Ban</td>
                                                </tr>
                                                <tr style="background-color:#370c4a">
                                                    <td>07.52 WIB 25/05/22</td>
                                                    <td>Fauzi Alfath</td>
                                                    <td>0829138133</td>
                                                    <td>Toyota Supra</td>
                                                    <td>B 9821 WQ</td>
                                                    <td>MBZ</td>
                                                    <td>A</td>
                                                    <td>Mogok</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    
                        </div>
                    </div>
                </div>
            </div>
@endsection