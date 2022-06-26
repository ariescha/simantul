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

        const ctx_1 = document.getElementById('myChart_1');
        
        const myChart_1 = new Chart(ctx_1, config);
        const ctx_2 = document.getElementById('myChart_2');
        const myChart_2 = new Chart(ctx_2, config);
        const ctx_3 = document.getElementById('myChart_3');
        const myChart_3 = new Chart(ctx_3,config);
        const ctx_4 = document.getElementById('myChart_4');
        const myChart_4 = new Chart(ctx_4,config);
        	// round corners
	// Chart.pluginService.register({
	// 	afterUpdate: function (chart) {
	// 		if (chart.config.options.elements.arc.roundedCornersFor !== undefined) {
	// 			var arc = chart.getDatasetMeta(0).data[chart.config.options.elements.arc.roundedCornersFor];
	// 			arc.round = {
	// 				x: (chart.chartArea.left + chart.chartArea.right) / 2,
	// 				y: (chart.chartArea.top + chart.chartArea.bottom) / 2,
	// 				radius: (chart.outerRadius + chart.innerRadius) / 2,
	// 				thickness: (chart.outerRadius - chart.innerRadius) / 2 - 1,
	// 				backgroundColor: arc._model.backgroundColor
	// 			}
	// 		}
	// 	},

	// 	afterDraw: function (chart) {
	// 		if (chart.config.options.elements.arc.roundedCornersFor !== undefined) {
	// 			var ctx = chart.chart.ctx;
	// 			var arc = chart.getDatasetMeta(0).data[chart.config.options.elements.arc.roundedCornersFor];
	// 			var startAngle = Math.PI / 2 - arc._view.startAngle;
	// 			var endAngle = Math.PI / 2 - arc._view.endAngle;

	// 			ctx.save();
	// 			ctx.translate(arc.round.x, arc.round.y);
	// 			console.log(arc.round.startAngle)
	// 			ctx.fillStyle = arc.round.backgroundColor;
	// 			ctx.beginPath();
	// 			ctx.arc(arc.round.radius * Math.sin(startAngle), arc.round.radius * Math.cos(startAngle), arc.round.thickness, 0, 2 * Math.PI);
	// 			ctx.arc(arc.round.radius * Math.sin(endAngle), arc.round.radius * Math.cos(endAngle), arc.round.thickness, 0, 2 * Math.PI);
	// 			ctx.closePath();
	// 			ctx.fill();
	// 			ctx.restore();
	// 		}
	// 	},
	// });

	// // write text plugin
	// Chart.pluginService.register({
	// 	afterUpdate: function (chart) {
	// 		if (chart.config.options.elements.center) {
	// 			var helpers = Chart.helpers;
	// 			var centerConfig = chart.config.options.elements.center;
	// 			var globalConfig = Chart.defaults.global;
	// 			var ctx = chart.chart.ctx;

	// 			var fontStyle = helpers.getValueOrDefault(centerConfig.fontStyle, globalConfig.defaultFontStyle);
	// 			var fontFamily = helpers.getValueOrDefault(centerConfig.fontFamily, globalConfig.defaultFontFamily);

	// 			if (centerConfig.fontSize)
	// 				var fontSize = centerConfig.fontSize;
	// 				// figure out the best font size, if one is not specified
	// 			else {
	// 				ctx.save();
	// 				var fontSize = helpers.getValueOrDefault(centerConfig.minFontSize, 1);
	// 				var maxFontSize = helpers.getValueOrDefault(centerConfig.maxFontSize, 256);
	// 				var maxText = helpers.getValueOrDefault(centerConfig.maxText, centerConfig.text);

	// 				do {
	// 					ctx.font = helpers.fontString(fontSize, fontStyle, fontFamily);
	// 					var textWidth = ctx.measureText(maxText).width;

	// 					// check if it fits, is within configured limits and that we are not simply toggling back and forth
	// 					if (textWidth < chart.innerRadius * 2 && fontSize < maxFontSize)
	// 						fontSize += 1;
	// 					else {
	// 						// reverse last step
	// 						fontSize -= 1;
	// 						break;
	// 					}
	// 				} while (true)
	// 				ctx.restore();
	// 			}

	// 			// save properties
	// 			chart.center = {
	// 				font: helpers.fontString(fontSize, fontStyle, fontFamily),
	// 				fillStyle: helpers.getValueOrDefault(centerConfig.fontColor, globalConfig.defaultFontColor)
	// 			};
	// 		}
	// 	},
	// 	afterDraw: function (chart) {
	// 		if (chart.center) {
	// 			var centerConfig = chart.config.options.elements.center;
	// 			var ctx = chart.chart.ctx;

	// 			ctx.save();
	// 			ctx.font = chart.center.font;
	// 			ctx.fillStyle = chart.center.fillStyle;
	// 			ctx.textAlign = 'center';
	// 			ctx.textBaseline = 'middle';
	// 			var centerX = (chart.chartArea.left + chart.chartArea.right) / 2;
	// 			var centerY = (chart.chartArea.top + chart.chartArea.bottom) / 2;
	// 			ctx.fillText(centerConfig.text, centerX, centerY);
	// 			ctx.restore();
	// 		}
	// 	},
	// })


	// var config = {
	// 	type: 'doughnut',
	// 	data: {
	// 		labels: [
	// 			"Red",
	// 			"Gray"
	// 		],
	// 		datasets: [{
	// 			data: [67, 33],
	// 			backgroundColor: [
	// 				"#FF6684",
	// 				"#ccc"
	// 			],
	// 			hoverBackgroundColor: [
	// 				"#FF6384",
	// 				"#ccc"
	// 			]
	// 		}]
	// 	},
	// 	options: {
	// 		elements: {
	// 			arc: {
	// 				roundedCornersFor: 0
	// 			},
	// 			center: {
	// 				// the longest text that could appear in the center
	// 				maxText: '100%',
	// 				text: '67%',
	// 				fontColor: '#FF6684',
	// 				fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
	// 				fontStyle: 'normal',
	// 				// fontSize: 12,
	// 				// if a fontSize is NOT specified, we will scale (within the below limits) maxText to take up the maximum space in the center
	// 				// if these are not specified either, we default to 1 and 256
	// 				minFontSize: 1,
	// 				maxFontSize: 256,
	// 			}
	// 		}
	// 	}
	// };


	// 	var ctx = document.getElementById("myChart").getContext("2d");
	// 	var myChart = new Chart(ctx, config);

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