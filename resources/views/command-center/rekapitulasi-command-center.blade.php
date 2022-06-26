@extends('master')
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 pull-right">
                    <div class="col-lg-3">
                        <label for="date" class="form-control">Filter tanggal :</label>
                    </div>
                    <div class="col-lg-3">
                        <form id="form-tanggal" method="post" enctype="multipart/form-data">
                            {{  csrf_field  }}
                            <input id="tanggal" name="tanggal" class="date form-control" type="text" placeholder="dd-mm-yyyy">
                            <button id="search" name="search"  class="btn rounded-pill btn-sm btn-warning" onclick="searchTanggal()">
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-list"></i></button>
                        <center style="color:white">
                            <h1 id="nilai-diterima">0</h1>
                            <h5>Diterima</h5>
                        </center>
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-share"></i></button>
                        <center style="color:white">
                            <h1 id="nilai-diteruskan">0</h1>
                            <h5>Diteruskan</h5>
                        </center>
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-check"></i></button>
                        <center style="color:white">
                            <h1 id="nilai-ditindak">0</h1>
                            <h5>Ditindak</h5>
                        </center>         
                    </div>
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" style="width:100%" class="btn btn-primary">EXPORT DATA</button>
                </div>              
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // $('#tanggal').datepicker({  
        // format: 'dd-mm-yyyy',
        // autoclose: true
        // });

        $('#tanggal').datepicker({
                    autoclose : true,
                    todayHighlight : true,
                    clearBtn: true,
                    format: 'yyyy-mm-dd', 
                    onSelect: function(value, date) { 
                        console.log('aaaa');
                    },
                    todayBtn: "linked",
                    startView: 0, maxViewMode: 0,minViewMode:0

                    }).on('changeDate',function(ev){
                    //this is right events ，trust me
                    console.log(ev.format([ix], [format]))
                    });
        

        $(document).ready(function() {
            LoadRekapitulasi();
            
        });

        function LoadRekapitulasi() {
            console.log('Load Rekapitulasi');
            $.ajax({
                url: "{{url('/LoadRekapitulasi')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    document.getElementById('nilai-diterima').innerHTML = data.data[0]['cnt_diterima'];
                    document.getElementById('nilai-diteruskan').innerHTML = data.data[0]['cnt_diteruskan'];
                    document.getElementById('nilai-ditindak').innerHTML = data.data[0]['cnt_ditindak'];
                }
            });

            setTimeout(function() {
                // LoadRekapitulasi();
            }, 3000);
        }
    
    
    
    </script>
@endsection