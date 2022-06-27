@extends('master')
<style>
    .redRow{
        background-color:red !important;
    }
    .orangeRow{
        background-color: orange !important;
    }
</style>
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
                                                    <th style="display:none;">Status Prioritas</th>
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
                                                    <th>Teruskan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color:black">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center"></tr>
                                                
                                            </tbody>
                                        </table>     
                                </div>
                                <!-- <form id="form-forward" method="post" enctype="multipart/form-data">
                                    {{  csrf_field()  }}
                                    <input type="hidden" id="laporan_id" type="number" name="laporan_id">
                                </form> -->
                        </div>    
                    </div>
                </div>
            </div>
            


    <!-- Modal -->
<div class="modal fade" id="forward" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Teruskan Ke Petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="row">
                <h5>Mobile Customer Service</h5>
                <div class="col-lg-12">
                    <div class="form-group row">
                        <button type="button" class="btn btn-vehicle" style="border:1px solid #5E0F80;width:140px">K01</button>
                        <button type="button" class="btn btn-vehicle" style="border:1px solid #5E0F80;width:140px">K02</button>
                        <button type="button" class="btn btn-vehicle" style="border:1px solid #5E0F80;width:140px">K03</button>
                    </div>
                    
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Assign Tugas</button>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">
        
        $(document).ready(function() {
            LoadLaporanTic();
        });

        function assignPetugas(id){
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

        //table cso
        function LoadLaporanTic(){
            console.log('LoadLaporanTic');
            $.ajax({
                url: "{{url('/LoadLaporanTic')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Laporan').DataTable({
                        "order":[[0, 'desc'],[1,'desc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "priority_id"},
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
                            { "data": "laporan_id"}

                        ],
                        columnDefs: [
                        {
                            targets: 0,
                            visible: false,
                            searchable: false,
                        },
                        {"targets": 11,
                            "data": null,
                            "render": function (data, type, row, meta){
                                return '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#forward"><i class="fa fa-share"></i></button> <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button> <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';}
                                
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
                }
            });

            setTimeout(function () {
                LoadLaporanTic();
            }, 30000);
        }
    </script>
@endsection