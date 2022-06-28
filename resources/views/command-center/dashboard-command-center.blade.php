@extends('master')
<style>
    .redRow{
        background-color:red !important;
    }
    .redRow:hover{
        background-color:red !important;
    }
    .orangeRow{
        background-color: orange !important;
    }
    .orangeRow:hover{
        background-color: orange !important;
    }
</style>
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
						
                    <div class="custom-tabs-line tabs-line-bottom left-aligned">
                       <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="table-responsive text-nowrap">
                                <table id="Laporan" class="table table-hover" style="background-color:white; width:100%">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th style="display:none;">Status Prioritas</th>
                                            <th>Waktu Laporan</th>
                                            <th>Nama</th>
                                            <th>No. Handphone</th>
                                            <th>Ruas</th>
                                            <th>KM</th>
                                            <th>Jalur</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Plat Nomor</th>
                                            <th>Jenis Kendala</th>
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    asa
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    isi
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
                    icon: "question",
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
                        "order": [[0,'desc']],
                        "scrollX": true,
                        "columns":[
                            { "data": "priority_id"},
                            { "data": "laporan_created_timestamp"},
                            { "data": "laporan_name"},
                            { "data": "laporan_phone_no"},
                            { "data": "ruas_name"},
                            { "data": "laporan_km"},
                            { "data": "laporan_jalur"},
                            { "data": "laporan_vehicle_category"},
                            { "data": "laporan_plat_no"},
                            { "data": "kendala"},
                            { "data": "laporan_description"},
                            { "data": "laporan_id"},
                        ],
                        "columnDefs": [
                            {"targets": 11,
                            "data": null,
                            "render": function (data, type, row, meta){
                                return '<button id="forward-to-tic" class="btn rounded-pill btn-sm btn-warning" onclick="forwardtic(`' + 
                                row.laporan_id + '`)">Forward</button>';}
                            },
                            {
                            targets: 0,
                            visible: false,
                            searchable: false,
                            }
                        ],
                        "createdRow": function (row, data, index) {
                            if (data.priority === "High") {
                                $(row).addClass('redRow');
                            }else if(data.priority === "Medium"){
                                $(row).addClass('orangeRow');
                            }
                        }
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