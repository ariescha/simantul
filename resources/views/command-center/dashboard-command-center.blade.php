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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="table-responsive text-nowrap">
                                <table id="Laporan" class="table table-hover" style="background-color:white; width:100%">
                                    <thead>
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
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                    
                            </div>
                            <form id="form-forward" method="post" enctype="multipart/form-data">
                                {{  csrf_field()  }}
                                <input type="hidden" id="laporan_id" type="number" name="laporan_id">
                            </form>
                        </div>                
                    </div>
                </div>
            </div>

    <script type="text/javascript">

        function forwardtic(id){
                console.log('Forward to TIC')
                $('#laporan_id').val(id);
                Swal.fire({
                    title: "Apakah Anda Yakin",
                    text: "Ingin Meneruskan Laporan Ke TIC Area?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    console.log(result);
                    if(result['value'] == true){
                        $.ajax({
                            url:"{{url('/ForwardTIC')}}",
                            method:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:$('#form-forward').serialize(),
                            dataType:'json',
                            error: function(e) {
                                console.log(e);
                                console.log('Forward to TIC Error');
                                Swal.fire('Gagal Meneruskan Ke TIC Area!', '', 'error')
                                // ShowNotif('Forward to TIC Gagal!', 'red');
                            },
                            success:function(data)
                            {
                                console.log(data);
                                if(data.status){
                                    Swal.fire('Berhasil Diteruskan Ke TIC Area!', '', 'success');
                                    LoadLaporan();
                                }
                                else{
                                    ShowNotif(data.data, 'red');
                                }
                            }
                        })                        
                        // Swal.fire('Berhasil Diteruskan Ke TIC Area!', '', 'success');
                    }
                });
            }


        $(document).ready(function() {
            LoadLaporan();
            // setInterval(LoadLaporan, 3000);
        });

        // setInterval(LoadLaporan, 3000);

        function LoadLaporan(){
            // $('loader').show();
            console.log('LoadLaporan');
            $.ajax({
                url: "{{url('/LoadLaporan')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                    // $('#loader').hide();
                    // ShowNotif('LoadLaporan Gagal', 'red');
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Laporan').DataTable({
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "laporan_created_timestamp"},
                            { "data": "laporan_name"},
                            { "data": "laporan_phone_no"},
                            { "data": "laporan_vehicle_category"},
                            { "data": "laporan_plat_no"},
                            { "data": "laporan_ruas_id"},
                            { "data": "laporan_jalur"},
                            { "data": "laporan_description"},
                            { "data": "laporan_id"},
                        ],
                        "columnDefs": [
                            {"targets": 8,
                            "data": null,
                            "render": function (data, type, row, meta){
                                return '<button id="forward-to-tic" class="btn rounded-pill btn-sm btn-warning" onclick="forwardtic(`' + 
                                row.laporan_id + '`)">Forward</button>';}
                            },
                        ]
                    });
                    // $('#loader').hide();
                }
            });

            setTimeout(function () {
                // alert("Hello " + i);
                // jsHello(--i);
                LoadLaporan();
            }, 3000);

        }
    </script>
@endsection