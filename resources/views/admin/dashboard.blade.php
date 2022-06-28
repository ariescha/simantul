@extends('master')

@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
									
                                    <div class="row">
                                    <div class="table-responsive text-nowrap">
                                    <table id="Laporan" class="table table-hover" style="background-color:white;width:100%">
                                            <thead style="color:black">
                                                <tr style="text-align:center">
                                                    <th>Waktu Laporan</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Jenis Kendala</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Ruas</th>
                                                    <th>Jalur</th>
                                                    <th>KM</th>
                                                    <th>Keterangan</th>
                                                    <th>CSO</th>
                                                    <th>Command Center</th>
                                                    <th>TIC</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color:black">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center"></tr>
                                                
                                            </tbody>
                                        </table>     
                                </div>
                        </div>    
                    </div>
                </div>
            </div>
            









    <script type="text/javascript">
        
        $(document).ready(function() {
            LoadLaporanAdmin();

        });


        //table cso
        function LoadLaporanAdmin(){
            // console.log('LoadLaporanCso');
            $.ajax({
                url: "{{url('/LoadLaporanAdmin')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Laporan').DataTable({
                        "order":[[0, 'desc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "laporan_created_timestamp"},
                            { "data": "laporan_name"},
                            { "data": "laporan_phone_no"},
                            { "data": "laporan_vehicle_category"},
                            { "data": "kendala"},
                            { "data": "laporan_plat_no"},
                            { "data": "ruas_name"},
                            { "data": "laporan_jalur"},
                            { "data": "laporan_km"},
                            { "data": "laporan_description"},
                            { "data": "cso_id_name"},
                            { "data": "command_center_id_name"},
                            { "data": "tic_id_name"},
                            { "data": "status_name"}
                        ]
                    });
                }
            });

            setTimeout(function () {
                LoadLaporanAdmin();
            }, 30000);
        }
    </script>
@endsection