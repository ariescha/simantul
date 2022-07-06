@extends('master')
@section('content')
@section('rekap-cc')
active
@endsection
<style>
    .dropdown-area{display:block;width:100%;margin-left:16px;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#fff;background-color:#471f61;background-image:none;border:1px solid #471f61;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
    .dropdown-area:focus{border-color:#471f61;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)}
</style>
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 pull-right">
                    <div class="col-lg-4 pull-right">
                    <form action="{{route('rekap-cc-export')}}" method="post" enctype="multipart\form-data">
                        {{ csrf_field()}}
                            <input id="tanggal" name="tanggal" class="date form-control" type="text" placeholder="dd-mm-yyyy" onchange="LoadRekapitulasiCC()">
                    </div>
                    <div class="col-lg-3 pull-right">
                        <label for="date" style="padding-top:20px;padding-left:50px;color:white">Filter tanggal :</label>
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
                    <button type="submit" style="width:100%" class="btn btn-primary">EXPORT DATA</button>
                    </form>
                </div>  
                
            
            </div>
            <br>
            
            <div class="col-lg-4">
                <!-- <form action="post" id="form-area" method="post"multipart="enctype/form-data">
                    {{csrf_field()}}
                    <select name="area" id="area" class="dropdown-area" onchange="LoadChart()">
                        <option value="" disabled selected>Pilih Area</option>
                        <option value="1">Metropolitan</option>
                        <option value="2">Transjawa</option>
                        <option value="3">Nusantara</option>
                    </select>
                </form> -->
            </div>
            <!-- <div class="col-lg-12" id="chart-area"> -->
                
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
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

                    });
        

        $(document).ready(function() {
            LoadRekapitulasiCC();
        });

        function LoadRekapitulasiCC() {
            console.log('Load Rekapitulasi CC');
        
            if($('#tanggal').val()){
                var a = $('#tanggal').val();
            }else{
                var a = 0;
            }
            console.log(a);
            $.ajax({
                url: "{{url('/LoadRekapitulasiCC')}}"+"/"+a,
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
                // LoadRekapitulasiCC();
            }, 3000);
        }
        

        // function LoadChart() {
        //     var a = $('#area').val();
        //     console.log(a);
        //     $.ajax({
        //         url: "{{url('/LoadChart')}}"+"/"+a,
        //         type: 'GET',
        //         dataType: 'json',
        //         error: function(e) {
        //             console.log(e);
        //         },
        //         success: function(data) {
        //             console.log(data.data);
        //             var temp = data.data[0]; 
        //             const elements = document.getElementsByClassName('chart-canvas');
        //             while(elements.length > 0){
        //                 elements[0].parentNode.removeChild(elements[0]);
        //             }
        //             for(var i=0; i < temp.length; i++){
        //                 let pipi = data.data[2][i] + "%";

        //                 let counter ={
        //                     'id' : 'counter',
        //                     beforeDraw(chart,args,options){

        //                         const {ctx,chartArea:{top,right,bottom,left,width,height}}= chart;
        //                         ctx.save();
        //                         ctx.font = '20px Helvetica';
        //                         ctx.textAlign = 'center';
        //                         ctx.fillStyle = 'rgba(71, 16, 107, 1)';
        //                         ctx.fillText(pipi,width/2,top+(height/2));
        //                     }
        //                 };
        //                 let config = {
        //                     type: 'doughnut',
        //                     data: {
        //                         datasets: [{
        //                             label: '# of Votes',
        //                             data: [data.data[1][i],data.data[0][i]],
        //                             backgroundColor: [
        //                                 'rgba(71, 16, 107, 1)',
        //                                 'rgba(222, 236, 254, 1)'
        //                             ],
        //                             borderColor: [
        //                                 'rgba(71, 16, 107, 0.2)',
        //                                 'rgba(222, 236, 254, 0.2)'
        //                             ],
        //                             borderJoinStyle: 'round',
        //                             borderRadius: [30,30],
        //                             borderWidth: 1,
        //                             cutout: '70%',
                                    
        //                         }]
        //                     },
        //                     options: {
        //                         responsive:true,
                                
        //                     },
        //                     plugins:[counter]
        //                 };  
        //                 $('#chart-area').append(`<div class="col-lg-3 chart-canvas">
        //                     <div class="breadcome-list" style="background-color:white;border-radius:10px;">
        //                         <canvas id="myChart_${i}"></canvas> <br>
        //                         <button type="button" class="btn" style="width:100%;color:white;background-color:#47106B ;border-radius:30px">${data.data[3][i]}</button>
        //                     </div>
        //                 </div>`);
        //                 var charr = document.getElementById('myChart_'+i);
        //                 new Chart(charr, config);

        //             }
                    
                    
        //         }

        //     });}
    </script>
@endsection