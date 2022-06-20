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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPermintaan">+ Tambah Data</button>
                                    
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
                                                </tr>
                                            </thead>
                                            <tbody style="color:white">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center">
                                                    <td>07.52 WIB 25/05/22</td>
                                                    <td>Sutrisna</td>
                                                    <td>0821931313</td>
                                                    <td>Honda Jazz</td>
                                                    <td>B 8172 WQ</td>
                                                    <td>Jagorawi</td>
                                                    <td>A</td>
                                                    <td>Pecah Ban</td>
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
                                                </tr>
                                            </tbody>
                                        </table>     
                                </div>
                        </div>    
                    </div>
                </div>
            </div>
<!-- Modal -->
<div class="modal fade" id="tambahPermintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Permintaan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <input type="text" class="form-control" placeholder="Nama">
                    </div>
                    <div class="row">
                        <input type="text" class="form-control" placeholder="No Handphone">
                    </div>
                    <div class="row">
                        <input type="text" class="form-control" placeholder="Jenis Mobil">
                    </div>
                    <div class="row" >
                        <div class="input-group">
                            Jenis Kendala :
                            <div class="row">
                                <input type="radio" id="pecah_ban" name="jenis_kendala" class="" value="pecah ban" >
                                <label for="pecah_ban">Pecah Ban</label>
                            </div>
                            <div class="row">
                                <input type="radio" id="mogok" name="jenis_kendala" class="" value="mogok">
                                <label for="mogok">Mogok</label>
                            </div>
                            <div class="row">
                                <input type="radio" id="kehabisan_bbm" name="jenis_kendala" class="" value="kehabisan bbm">
                                <label for="kehabisan_bbm">Kehabisan BBM</label>
                            </div>
                        </div>
                            
                            
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <input type="text" placeholder="Plat Nomor" class="form-control">
                    </div>
                    <div class="row">
                        <select name="" id="" class="form-control" >
                            <option value="" disabled selected>Pilih Ruas</option>
                            <option value="">Jagorawi</option>
                        </select>
                    </div>
                    <div class="row">
                        Jalur :
                        <input type="radio" id="jalur_a" name="jalur" value="A">
                        <label for="jalur_a">Jalur A</label>
                        <input type="radio" id="jalur_b" name="jalur" value="B">
                        <label for="jalur_b">Jalur B</label>
                    </div>
                    <div class="row">
                        <textarea name="" id="" cols="30" rows="10" class="form-control">Keterangan...</textarea>
                    </div>
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Tambah Data</button>
      </div>
    </div>
  </div>
</div>

@endsection