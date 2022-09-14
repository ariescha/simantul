@extends('master')
@section('content')
@section('rekap-cc')
active
@endsection
<style>
    .dropdown-area {
        display: block;
        width: 100%;
        margin-left: 16px;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #fff;
        background-color: #471f61;
        background-image: none;
        border: 1px solid #471f61;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
    }

    .dropdown-area:focus {
        border-color: #471f61;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6)
    }
</style>
<div class="breadcome-area">
    <div class="container-fluid">
        <form action="{{route('rekap-cc-export')}}" method="post" enctype="multipart\form-data">
            {{ csrf_field()}}
            <div class="row">
                <div class="col-lg-4">
                    <label for="date" style="padding-top:20px;padding-left:10px;">Filter tanggal :</label>
                    <input id="tanggal" class="date form-control" type="text" placeholder="dd-mm-yyyy" readonly onchange="LoadRekapitulasiCC()">

                    <input type="hidden" name="tanggal_start" id="tanggal_start">
                    <input type="hidden" name="tanggal_end" id="tanggal_end">
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
        </form>
    </div>
</div>
</div>
<script src="{{asset('assets/js/calendar/moment.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<script src="{{asset('assets/js/daterange/daterangepicker.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/css/daterange/daterangepicker.css')}}">
<!-- Include Date Range Picker -->

<script type="text/javascript">
    $('#tanggal').daterangepicker({
        autoApply: true,
        locale: {
            format: 'YYYY-MM-DD',
        },
        startDate: moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD'),
        endDate: moment().format('YYYY-MM-DD'),
    });

    $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
        let tanggal_start = picker.startDate.format('YYYY-MM-DD')
        let tanggal_end = picker.endDate.format('YYYY-MM-DD')
        console.log(tanggal_start, tanggal_end);
        $('#tanggal_start').val(tanggal)
        $('#tanggal_end').val(tanggal)
    });

    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        $('#tanggal').val('')
        $('#tanggal_start').val('')
        $('#tanggal_end').val('')
    });


    $(document).ready(function() {
        LoadRekapitulasiCC();
    });

    function LoadRekapitulasiCC() {
        console.log('Load Rekapitulasi CC');

        $.ajax({
            url: "{{url('/LoadRekapitulasiCC')}}",
            type: 'GET',
            dataType: 'json',
            data: {
                tanggal_start: $('#tanggal_start').val(),
                tanggal_end: $('#tanggal_end').val()
            },
            error: function(e) {
                console.log(e);
            },
            success: function(data) {
                // console.log(data.data);
                document.getElementById('nilai-diterima').innerHTML = data.data[0]['cnt_diterima'];
                document.getElementById('nilai-diteruskan').innerHTML = data.data[0]['cnt_diteruskan'];
                document.getElementById('nilai-ditindak').innerHTML = data.data[0]['cnt_ditindak'];
            }
        });
    }
</script>
@endsection