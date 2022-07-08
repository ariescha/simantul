@extends('master')
<style>
    .redRow,
    .redRow:hover{
        background-color:#F5413D !important;
    }
    
    .orangeRow,
    .orangeRow:hover{
        background-color: orange !important;
        color: black !important;

    }
</style>
@section('dashboard-cc')
active
@endsection
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                    <div class="custom-tabs-line tabs-line-bottom left-aligned">
                       <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li role="presentation" class="active"><a href="#sedang-proses" aria-controls="home" role="tab" data-toggle="tab">Sedang proses</a></li>
                        <li role="presentation"><a href="#selesai-diteruskan" aria-controls="profile" role="tab" data-toggle="tab">Selesai diteruskan</a></li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane active" id="sedang-proses" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="table-responsive text-nowrap">
                                    <table id="Laporan" class="table table-hover" style="background-color:#2f0042;color:white;border:none; width:100%">
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
                                
                            </div>                   
                        </div>
                        <div class="tab-pane" id="selesai-diteruskan" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                                <div class="table-responsive text-nowrap">
                                    <table id="Laporan_selesai" class="table table-hover" style="background-color:#2f0042;border:none; width:100%">
                                        <thead>
                                            <tr style="text-align:center">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                        
                                </div>
                            </div> 
                        </div>
                    </div>
  <!-- Modal -->
<div class="modal fade" id="assign-ruas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Assign Ruas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="form-assign-ruas" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <input type="hidden" id="laporan_id" name="laporan_id">
                <div class="col-lg-2">
                    <label for="ruas" class="form-label" style="padding-top:20px">Ruas</label>
                </div>
                <div class="col-lg-7">
                    
                    <select name="ruas" id="ruas" class="form-control">
                        <option value="" disabled>Pilih ruas</option>
                        @foreach($ruas as $r)
                        <option value="{{$r->ruas_id}}">{{$r->ruas_name}}</option>
                        @endforeach
                    </select> 
                </div>
            </form>
                
                <br><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="forwardtic()">Assign Ruas</button>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">
        var old_row = 0;

        function forwardRuas(id,ruas_id){
            
            document.getElementById("laporan_id").value = id;
            document.getElementById("ruas").value = ruas_id;

        }
        function forwardtic(id){
                console.log('Forward to TIC')
                $('#assign-ruas').modal('hide');
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
                            data:$('#form-assign-ruas').serialize(),
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
                                    LoadLaporanSelesai();
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
            LoadLaporanSelesai();
            $('#sedang-proses').tab('show');
            // setInterval(LoadLaporan, 3000);
            
            // const playSound = (url) => {
            //             const audio = new Audio(url);
            //             audio.play();
            //             }
        });

        // const button = document.querySelector('forward-to-tic');
        // button.addEventListener('click', () => {
        // console.log(button);
        // playSound('https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3')});

        // setInterval(LoadLaporan, 3000);
        function LoadLaporanSelesai(){
            // $('loader').show();
            console.log('LoadLaporanSelesai');
            $.ajax({
                url: "{{url('/LoadLaporanSelesai')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                    // $('#loader').hide();
                    // ShowNotif('LoadLaporan Gagal', 'red');
                },
                success: function(data) {
                    $('#Laporan_selesai').DataTable({
                        "destroy": true,
                        "aaData": data.data,
                        "order": [[0, 'desc'],[1,'desc']],
                        "scrollX": true,
                        "columns":[
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
                        ],
                    });
                    // $('#loader').hide();
                }
            });

            setTimeout(function () {
                // alert("Hello " + i);
                // jsHello(--i);
                LoadLaporanSelesai();
            }, 3000);

        }
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
                        "order": [[0, 'desc'],[1,'asc']],
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
                            // { "data": "laporan_id"},
                        ],
                        "columnDefs": [
                            {"targets": 11,
                            "data": null,
                            "render": function (data, type, row, meta){
                                return '<button id="forward-to-tic" class="btn rounded-pill btn-sm btn-warning" data-toggle="modal" data-target="#assign-ruas" onclick="forwardRuas(`'+row.laporan_id+'`,`'+row.ruas_id+'`)">Forward</button>';}
                            },
                            {
                            targets: 0,
                            visible: false,
                            searchable: false,
                            },
                        ],
                        "createdRow": function (row, data, index) {
                            if (data.priority === "High") {
                                $(row).addClass('redRow');
                            }else if(data.priority === "Medium"){
                                $(row).addClass('orangeRow');
                            }
                        }
                    });
                    var new_row = data.data.length;
                    // if(new_row > old_row && old_row != 0){
                    //     const playSound = (url) => {
                    //     const audio = new Audio(url);
                    //     audio.play();}
                    //     playSound('https://www.mboxdrive.com/tenong.mp3');
                    //     old_row = new_row;
                    // }
                    // else{
                    //     old_row = new_row;
                    // }
                    // $('#loader').hide();
                }
            });

            setTimeout(function () {
            //     // alert("Hello " + i);
            //     // jsHello(--i);
                LoadLaporan();
            }, 3000);

        }
    </script>
@endsection