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
                        <select name="date" id="date" class="form-control">
                            <option value="">dd/mm/yyyy</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-list"></i></button>
                        <center style="color:white">
                            <h1>8</h1>
                            <h5>Diterima</h5>
                        </center>
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-share"></i></button>
                        <center style="color:white">
                            <h1>1</h1>
                            <h5>Diteruskan</h5>
                        </center>
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="breadcome-list" style="background-color:#471f61;border-radius:10px">
                        <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-check"></i></button>
                        <center style="color:white">
                            <h1>20</h1>
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
@endsection