@extends('master')
@section('content')
<style>
    .dropdown-area{display:block;width:100%;margin-left:16px;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#fff;background-color:#471f61;background-image:none;border:1px solid #471f61;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
    .dropdown-area:focus{border-color:#471f61;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)}
</style>
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 pull-right">
                    <div class="col-lg-3">
                        <label for="date" class="form-control">Filter tanggal :</label>
                    </div>
                    <div class="col-lg-3">
                        <form id="form-tanggal" method="post" enctype="multipart/form-data">
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
            <br>
            
            <div class="col-lg-4">
                <form action="post" id="form-area" method="post"multipart="enctype/form-data">
                    {{csrf_field()}}
                    <select name="area" id="area" class="dropdown-area" onchange="LoadChart()">
                        <option value="" disabled selected>Pilih Area</option>
                        <option value="1">Metropolitan</option>
                        <option value="2">Transjawa</option>
                        <option value="3">Nusantara</option>
                    </select>
                </form>
            </div>
            <div class="col-lg-12">
                
                <div class="col-lg-3">
                    <div class="breadcome-list" style="background-color:white;border-radius:10px;">
                        <canvas id="myChart_1"></canvas> <br>
                        <button type="button" class="btn" style="width:100%;color:white;background-color:#47106B ;border-radius:30px"> JORR </button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="breadcome-list" style="background-color:white;border-radius:10px;">
                        <canvas id="myChart_2"></canvas><br>
                        <button type="button" class="btn" style="width:100%;color:white;background-color:#47106B ;border-radius:30px"> DALKOT </button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="breadcome-list" style="background-color:white;border-radius:10px;">
                        <canvas id="myChart_3"></canvas><br>
                        <button type="button" class="btn" style="width:100%;color:white;background-color:#47106B ;border-radius:30px"> JAGORAWI </button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="breadcome-list" style="background-color:white;border-radius:10px;">
                        <canvas id="myChart_4"></canvas><br>
                        <button type="button" class="btn" style="width:100%;color:white;background-color:#47106B ;border-radius:30px"> JAPEK </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
        // $('#tanggal').datepicker({  
        // format: 'dd-mm-yyyy',
        // autoclose: true
        // });
        const counter = {
            'id' : 'counter',
            beforeDraw(chart,args,options){
                const {ctx,chartArea:{top,right,bottom,left,width,height}}= chart;
                ctx.save();
                ctx.font = '20px Helvetica';
                ctx.textAlign = 'center';
                ctx.fillStyle = 'rgba(71, 16, 107, 1)';
                ctx.fillText('97%',width/2,top+(height/2));
            }
        };

        const config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: '# of Votes',
                    data: [70,30],
                    backgroundColor: [
                        'rgba(71, 16, 107, 1)',
                        'rgba(222, 236, 254, 1)'
                    ],
                    borderColor: [
                        'rgba(71, 16, 107, 0.2)',
                        'rgba(222, 236, 254, 0.2)'
                    ],
                    borderJoinStyle: 'round',
                    borderRadius: [30,30],
                    borderWidth: 1,
                    cutout: '70%',
                    
                }]
            },
            options: {
                responsive:true,
                
            },
            plugins:[counter]
        };

        
        const ctx_2 = document.getElementById('myChart_2');
        const myChart_2 = new Chart(ctx_2, config);
        const ctx_3 = document.getElementById('myChart_3');
        const myChart_3 = new Chart(ctx_3,config);
        const ctx_4 = document.getElementById('myChart_4');
        const myChart_4 = new Chart(ctx_4,config);

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
            });setTimeout(function() {
                // LoadRekapitulasi();
            }, 3000);
        }
        
        // function submit_form_area(){
        //     $.ajax({
        //                     url:"{{url('/PilihRegion')}}",
        //                     method:"POST",
        //                     headers: {
        //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                     },
        //                     data:$('#form-area').serialize(),
        //                     dataType:'json',
        //                     error: function(e) {
        //                         console.log(e);
        //                         console.log('Forward to TIC Error');
        //                     },
        //                     success:function(data)
        //                     {
        //                         console.log(data);
        //                         LoadChart();
        //                     }
        //                 });
        // }
        function LoadChart() {
            var a = $('#area').val();
            console.log(a);
            $.ajax({
                url: "{{url('/LoadChart')}}"+"/"+a,
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    var temp = data.data[0]; 
                    for(var i=0; i < temp.length; i++){
                        var counter_1 = [];
                        counter_1.push({
                            'id' : 'counter',
                            beforeDraw(chart,args,options){
                                const {ctx,chartArea:{top,right,bottom,left,width,height}}= chart;
                                ctx.save();
                                ctx.font = '20px Helvetica';
                                ctx.textAlign = 'center';
                                ctx.fillStyle = 'rgba(71, 16, 107, 1)';
                                ctx.fillText(data.data[2][i],width/2,top+(height/2));
                            }
                        });
                        var config_1 = []
                        config_1.push({
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    label: '# of Votes',
                                    data: [data.data[1][i],data.data[0][i]],
                                    backgroundColor: [
                                        'rgba(71, 16, 107, 1)',
                                        'rgba(222, 236, 254, 1)'
                                    ],
                                    borderColor: [
                                        'rgba(71, 16, 107, 0.2)',
                                        'rgba(222, 236, 254, 0.2)'
                                    ],
                                    borderJoinStyle: 'round',
                                    borderRadius: [30,30],
                                    borderWidth: 1,
                                    cutout: '70%',
                                    
                                }]
                            },
                            options: {
                                responsive:true,
                                
                            },
                            plugins:[counter_1[i]]
                        });  
                    }

                    
                    const ctx = document.getElementById('myChart_1');
        
                    const myChart_1 = new Chart(ctx, config_1);
                }
            });}

            
    
    
    
    </script>
@endsection