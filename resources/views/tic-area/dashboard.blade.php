@extends('master')
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
									<div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-7">
                                                <button type="button" class="btn btn-primary">+ Tambah Data</button>
                                    
                                            </div>
                                            <div class="col-lg-5">
                                            <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading  pull-right">
                                                <form role="search" class="">
													<a href=""><i class="fa fa-search"></i></a>
													<input type="text" placeholder="Pencarian..." class="form-control">
												</form>
                                            </div></div></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                    <div class="bootstrap-table">
                                        <table id="table" class="table table-no-bordered">
                                            <thead style="color:white">
                                                <tr style="text-align:center">
                                                    <th>Waktu Laporan</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Ruas</th>
                                                    <th>Jalur</th>
                                                    <th>Keterangan</th>
                                                    <th>Teruskan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color:white">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#CB2713;text-align:center">
                                                    <td>07.52 WIB 25/05/22</td>
                                                    <td>Sutrisna</td>
                                                    <td>0821931313</td>
                                                    <td>Honda Jazz</td>
                                                    <td>B 8172 WQ</td>
                                                    <td>Jagorawi</td>
                                                    <td>A</td>
                                                    <td>Pecah Ban</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-share"></i></button>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>

                                                    </td>
                                                </tr>
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center">
                                                    <td>07.52 WIB 25/05/22</td>
                                                    <td>Fauzi Alfath</td>
                                                    <td>0829138133</td>
                                                    <td>Toyota Supra</td>
                                                    <td>B 9821 WQ</td>
                                                    <td>MBZ</td>
                                                    <td>A</td>
                                                    <td>Mogok</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-share"></i></button>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button>
                                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    
                        </div>
                                    </div>
                                    
                    </div>
                </div>
            </div>
@endsection