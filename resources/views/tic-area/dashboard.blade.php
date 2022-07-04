@extends('master')
<style>
    .redRow{
        background-color:#F5413D !important;
    }
    .orangeRow{
        background-color: #EDCA10 !important;
        color: black !important;
    }
    .btn-purple{
        color: #572890;
        width: 150px;
        background-color: #ffff;
        border-color: #882ea4 !important}
    .btn-purple.focus,
    .btn-purple:focus{
        color: #ffff !important;
        background-color: #662890;
        border-color: #122b40}
    .btn-purple:hover{
        color: #ffff !important;
        background-color: #572890;
        border-color: #5f2074}
    .btn-purple:active{
        color: #ffff !important;
        background-color: #572890;
        border-color: #5f2074}
    .no-click{
        cursor: pointer;
        pointer-events: none;
    }

        
    .cat{
    margin: 4px;
    background-color: #ffff;
    border-radius: 4px;
    border: 1px solid #2f0042;
    overflow: hidden;
    float: left;
    }

    .cat label {
    float: left; line-height: 3.0em;
    width: 8.0em; height: 3.0em;
    }

    .cat label span {
    text-align: center;
    padding: 3px 0;
    display: block;
    }

    .cat label input {
    position: absolute;
    display: none;
    color: #2f0042 !important;
    }

    /* selects all of the text within the input element and changes the color of the text */
    .cat label input + span{color: #2f0042;}


    /* This will declare how a selected input will look giving generic properties */
    .cat input:checked + span {
        color: #ffffff;
        text-shadow: 0 0  6px rgba(0, 0, 0, 0.8);
    }


    /*
    This following statements selects each category individually that contains an input element that is a checkbox and is checked (or selected) and chabges the background color of the span element.
    */
    .cat input:hover{
        cursor:hand !important;
    }
    .comedy input:checked + span{background-color: #2f0042;}
    .disable {background-color: grey;}

</style>
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
                                    <table id="Laporan" class="table table-hover" style="background-color:#2f0042;width:100%">
                                            <thead style="color:white">
                                                <tr style="text-align:center">
                                                    <th style="display:none;">Status Prioritas</th>
                                                    <th stype="display:none;">id laporan</th>
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
                                            <tbody style="color:black">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center"></tr>
                                            </tbody>
                                        </table>     
                                </div>
                                <form id="form-data" method="post" enctype="multipart/form-data">
                                    {{  csrf_field()  }}
                                    <input type="hidden" id="data_laporan_id" type="number" name="laporan_id">
                                </form>
                            </div> 
                         </div>
                            <div class="tab-pane" id="selesai-diteruskan" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="table-responsive text-nowrap">
                                    <table id="Laporan_selesai" class="table table-hover" style="background-color:#2f0042;width:100%">
                                            <thead style="color:white">
                                                <tr style="text-align:center">
                                                    <th style="display:none;">Status Prioritas</th>
                                                    <th stype="display:none;">id laporan</th>
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
                                            <tbody style="color:black">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center"></tr>
                                                
                                            </tbody>
                                        </table>     
                                </div>
                                <form id="form-data" method="post" enctype="multipart/form-data">
                                    {{  csrf_field()  }}
                                    <input type="hidden" id="data_laporan_id" type="number" name="laporan_id">
                                </form>
                        </div>    
                    </div>
                </div>
            </div>
        </div></div>
            


    <!-- Modal -->
<div class="modal fade" id="forward" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Teruskan Ke Petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="assign-petugas" method="post" enctype="multipart/form-data">
            {{  csrf_field() }}
            <input type="hidden" id="laporan_id" type="text" name="laporan_id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="assignPetugas()">Assign Tugas</button>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">

        $(document).ready(function() {
            LoadLaporanTic();
            LoadLaporanTicSelesai();

            $('#forward').on('hidden.bs.modal', function () {
                $('#assign-petugas').html("");
                $('#assign-petugas').append(`
                    <input type="hidden" id="laporan_id" type="text" name="laporan_id">
                `);
            })
        });
        function LoadDataPetugas(id){
            console.log('Load Data Petugas');
            $('#laporan_id').val(id);
            $.ajax({
                url:"{{url('/LoadDataPetugas')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e){
                    console.log(e);
                },
                success: function(data){
                    console.log(data.data);
                    var arr = data.data;
                    var x = 0;
                    var y = 0;
                    for (const i of arr['jenis_kendaraan']) {
                        
                        $('#assign-petugas').append(`
                            <div class="row">
                                <h5>${i['jenis_kendaraan']}</h5>
                                <div class="col-lg-12">
                                    <div id="list_nomor_kendaraan_${y}" class="form-group row">
                                    </div> 
                                </div>
                            </div>
                        `);
                        for (const j of arr['data_petugas_aktif']){
                            if (j['jenis_kendaraan'] == i['jenis_kendaraan']) {
                                if(j['onduty'] == 0){
                                    $('#list_nomor_kendaraan_'+y).append(`<div  class="cat comedy">
                                        <label>
                                            <input type="checkbox" name="data_petugas[${x}]" value="${j['data_petugas_id']}" style="border:1px solid #5E0F80;width:140px" class="btn btn-purple">
                                            <span>${j['kendaraan_nomor']}</span>
                                        </label> </div>
                                    `) ;
                                    x = x+1;
                                }
                                else{
                                    $('#list_nomor_kendaraan_'+y).append(`<div  class="cat disable">
                                        <label>
                                            <input type="checkbox" name="data_petugas[${x}]" value="${j['data_petugas_id']}" style="border:1px solid #5E0F80;width:140px" class="btn btn-purple" disabled>
                                            <span>${j['kendaraan_nomor']}</span>
                                        </label> </div>
                                    `) ;
                                    x = x+1;
                                }
                                

                            }
                        }
                        y = y+1;
                    }
                }
            })
        }

        function assignPetugas(){
            console.log('assignPetugas');
            $('#forward').modal('hide');
            $.ajax({
                url:"{{url('/AssignPetugas')}}",
                method:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:$('#assign-petugas').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    console.log('Assign Petugas Error');
                    Swal.fire('Gagal Assign Petugas!', '', 'error')
                    },
                success:function(data){
                    if(data.status){
                        Swal.fire('Berhasil Assign Petugas!', '', 'success');
                        LoadLaporanTic();
                    }
                    else{
                        ShowNotif(data.data, 'red');
                    }
                }
            })                        
                        // Swal.fire('Berhasil Diteruskan Ke TIC Area!', '', 'success');
        }

        function PetugasArrived(id){
            console.log('Set Petugas Arrived');
            $('#data_laporan_id').val(id);
            Swal.fire({
                    title: "Apakah Anda Yakin",
                    text: "Petugas Sudah Sampai di Lokasi Laporan?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    console.log(result);
                    if(result['value'] == true){
                        $.ajax({
                            url:"{{url('/PetugasArrived')}}",
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:$('#form-data').serialize(),
                            dataType:'json',
                            error: function(e) {
                                console.log(e);
                                console.log('Error Set Petugas Sudah Sampai');
                                Swal.fire('Gagal Input Petugas Sudah Sampai!', '', 'error')
                                // ShowNotif('Forward to TIC Gagal!', 'red');
                            },
                            success:function(data)
                            {
                                if(data.status){
                                    Swal.fire('Berhasil Input Petugas Sudah Sampai!', '', 'success');
                                    LoadLaporanTic();
                                }
                                else{
                                    ShowNotif(data.data, 'red');
                                }
                            }
                        })                        
                    }
                });
        }

        function PetugasDone(id){
            console.log('Set Petugas Done');
            $('#data_laporan_id').val(id);
            Swal.fire({
                    title: "Apakah Anda Yakin",
                    text: "Laporan Sudah Selesai Ditindak?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    console.log(result);
                    if(result['value'] == true){
                        $.ajax({
                            url:"{{url('/PetugasDone')}}",
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:$('#form-data').serialize(),
                            dataType:'json',
                            error: function(e) {
                                console.log(e);
                                console.log('Error Set Petugas Sudah Selesai');
                                Swal.fire('Gagal Input Petugas Sudah Selesai!', '', 'error')
                                // ShowNotif('Forward to TIC Gagal!', 'red');
                            },
                            success:function(data)
                            {
                                if(data.status){
                                    Swal.fire('Berhasil Input Petugas Sudah Selesai!', '', 'success');
                                    LoadLaporanTic();
                                    LoadLaporanTicSelesai();
                                }
                                else{
                                    ShowNotif(data.data, 'red');
                                }
                            }
                        })                        
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
                    $('#Laporan').DataTable({
                        "order":[[0, 'desc'],[2,'asc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "priority_id"},
                            { "data": "laporan_id"},
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
                        columnDefs: [
                        {
                            targets: 0,
                            visible: false,
                            searchable: false,
                        },
                        {
                            targets: 1,
                            visible: false,
                            searchable: false,
                        },
                        {"targets": 12,
                            "width":"270px",
                            "data": "status_id",
                            "render": function (data, type, row, meta){
                                if (data == 3){
                                    //laporan sudah assign petugas
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" title="Assign Petugas"><i class="fa fa-share"></i></button> <button id="btn_arrived" title="Petugas sampai di lokasi" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button> <button id="btn_done" title="Selesai ditindak" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 4){
                                    //laporan petugas sudah sampai
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" title="Assign Petugas"><i class="fa fa-share"></i></button> <button id="btn_arrived" title="Petugas sampai di lokasi" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" title="Selesai ditindak" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 5){
                                    //laporan done ditindak
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" title="Assign Petugas"><i class="fa fa-share"></i></button> <button id="btn_arrived" title="Petugas sampai di lokasi" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" title="Selesai ditindak" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 6){
                                    //laporan done tanpa ditindak
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" title="Assign Petugas"><i class="fa fa-share"></i></button> <button id="btn_arrived" title="Petugas sampai di lokasi" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" title="Selesai ditindak" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click"><i class="fa fa-check"></i></button>';
                                }
                                else{
                                    //laporan baru
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#forward" title="Assign Petugas"><i class="fa fa-share"></i></button>';
                                }        
                            }                        
                        },
                        {
                            targets: 11,
                            render: function (data, type, row) {
                                return type === 'display' && data.length > 30 ? data.substr(0, 30) + '…' : data;
                            }
                        }],
                        fixedColumns: true,
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
            }, 3000);
        }
        function LoadLaporanTicSelesai(){
            console.log('LoadLaporanTicSelesai');
            $.ajax({
                url: "{{url('/LoadLaporanTicSelesai')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    $('#Laporan_selesai').DataTable({
                        "order":[[0, 'desc'],[2,'desc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "priority_id"},
                            { "data": "laporan_id"},
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
                        columnDefs: [
                        {
                            targets: 0,
                            visible: false,
                            searchable: false,
                        },
                        {
                            targets: 1,
                            visible: false,
                            searchable: false,
                        },
                        {"targets": 12,
                            "data": "status_id",
                            "width":"270px",
                            "render": function (data, type, row, meta){
                                if (data == 3){
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" ><i class="fa fa-share"></i></button> <button id="btn_arrived" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button> <button id="btn_done" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 4){
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" ><i class="fa fa-share"></i></button> <button id="btn_arrived" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 5){
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" ><i class="fa fa-share"></i></button> <button id="btn_arrived" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click"><i class="fa fa-check"></i></button>';
                                }
                                else if(data == 6){
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" data-toggle="modal" data-target="#forward" ><i class="fa fa-share"></i></button> <button id="btn_arrived" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click" ><i class="fa fa-user"></i></button> <button id="btn_done" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-success no-click"><i class="fa fa-check"></i></button>';
                                }
                                else{
                                    return '<button id="btn_assign" type="button" onclick="LoadDataPetugas(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#forward"><i class="fa fa-share"></i></button> <button id="btn_arrived" type="button" onclick="PetugasArrived(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-user"></i></button> <button id="btn_done" type="button" onclick="PetugasDone(`' + row.laporan_id + '`)" class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>';
                                }        
                            }, 
                            
                        },
                        {
                            targets: 11,
                            render: function (data, type, row) {
                                return type === 'display' && data.length > 30 ? data.substr(0, 30) + '…' : data;
                            }
                        }],fixedColumns: true
                        
                        
                    });
                }
            });

            setTimeout(function () {
                LoadLaporanTicSelesai();
            }, 3000);
        }
    </script>
@endsection