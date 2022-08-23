@extends('master')
@section('data-petugas')
active
@endsection
@section('content')

<style>
    .icon:hover{
        transition: .5s ease;
        filter:brightness(70%);
        display: inline-block;
    }
</style>

    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                        <form  id="update_petugas" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        @foreach($data['kendaraan'] as $k => $v)
                        <?php $i = 0;?>
									<div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-7">
                                                
                                                <h4 style="color:white">{{$v->jenis_kendaraan}}</h4>
                                                <input type="hidden" name="id_kendaraan[{{$k}}]" id="id_kendaraan_[{{$k}}]" value="{{$v->jenis_kendaraan_id}}">

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div id="form_{{$k}}">
                                            @foreach($data['data_petugas'] as $key => $value)
                                                
                                                @if($value->kendaraan_jenis == $v->jenis_kendaraan_id)
                                            <div class="col-lg-12 element_{{$k}}" id="element_{{$k}}_{{$i}}">
                                                <div class="col-lg-1">
                                                    @if($v->jenis_kendaraan == "Derek")
                                                    <input type="text" style="width:40px"value="{{$value->kendaraan_nomor}}">
                                                    @else
                                                    <h5 style="color:white">{{$value->kendaraan_nomor}}</h5>
                                                    @endif
                                                    <input type="hidden" name="nomor_kendaraan[{{$k}}][{{$i}}]" name="nomor_kendaraan_[{{$k}}]_[{{$i}}]" value="{{$value->kendaraan_nomor}}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_1[{{$k}}][{{$i}}]" id="search_petugas_1_{{$k}}_{{$i}}" class="form-control" style="width:100%">
                                                        <option value="" disabled>Pilih petugas 1</option>
                                                        <option value="{{$value->npp_petugas_1}}" selected>{{$value->npp_petugas_1}}</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                @if($p->nama_petugas !== $value->npp_petugas_1)
                                                                <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_2[{{$k}}][{{$i}}]" id="search_petugas_2_{{$k}}_{{$i}}" class="form-control" style="width:100%">
                                                        <option value="" disabled>Pilih petugas 2</option>
                                                        <option value="{{$value->npp_petugas_2}}" selected>{{$value->npp_petugas_2}}</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                @if($p->nama_petugas !== $value->npp_petugas_2)
                                                                    <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="icon" id="btn_add_{{$k}}_{{$i}}" onclick="add_field('{{$k}}','{{$i}}','{{$value->kendaraan_nomor}}','{{$v->jenis_kendaraan}}')" style="background-color:transparent;border:none;" title="Tambah data"><img src="assets/img/icon/icon-add.png" alt="" style="width:20px"></button>
                                                    <button type="button" class="icon" id="btn_drop_{{$k}}_{{$i}}" onclick="drop_field('{{$k}}','{{$i}}','{{$value->kendaraan_nomor}}','{{$v->jenis_kendaraan}}')" style="background-color:transparent;border:none;"  title="Hapus data"><img src="assets/img/icon/icon-drop.png" alt="" style="width:20px"></button>
                                                </div>
                                            </div>
                                            <?php $i = $i+1;?>
                                            @endif
                                            @endforeach
                                        </div>
                                        </div>
                                    <br><br>
                            @endforeach 
                                <button type="button" class="btn btn-warning" style="width:100%" onclick="update()">Simpan Perubahan</button>
                            
                            </form>  
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var jumlah_kendaraan = <?php echo count($data['kendaraan']);?>;
        const lala = [];
        for(var i=0; i<jumlah_kendaraan; i++){
            lala[i] = document.getElementsByClassName("element_"+i).length;
        }
        for(var j=0; j<jumlah_kendaraan; j++){

            if(document.getElementById("btn_drop_"+j+"_0")){
                document.getElementById("btn_drop_"+j+"_0").remove();
            }
            for(var k=0; k<lala[j]-1; k++){
                $("#search_petugas_1_"+j+"_"+k).select2();
                $("#search_petugas_2_"+j+"_"+k).select2();

                document.getElementById("btn_add_"+j+"_"+k).style.display = "none";
                if(k>0){
                    document.getElementById("btn_drop_"+j+"_"+k).style.display = "none";
                }
            }
            for(var k=0; k<lala[j]; k++){
                $("#search_petugas_1_"+j+"_"+k).select2();
                $("#search_petugas_2_"+j+"_"+k).select2();}
        }
    });

    function add_field(id_jenis, id_kendaraan, nomor_kendaraan, txt_jenis){
        
        document.getElementById("btn_add_"+id_jenis+"_"+id_kendaraan).style.display = "none";
        
        if(id_kendaraan>0){
            document.getElementById("btn_drop_"+id_jenis+"_"+id_kendaraan).style.display = "none";
        }
        kode_awal = nomor_kendaraan.charAt(0);
        let kode_nomor = nomor_kendaraan.substr(1,nomor_kendaraan.length);
        kode_nomor++;
        kode_nomor.toString();
        if(kode_nomor.toString().length <= 1){
            kode_nomor = '0'+kode_nomor;
        }
        var kode_baru = kode_awal+kode_nomor;
        id_kendaraan++;
        console.log(txt_jenis);
        if(txt_jenis == "Derek"){
            $('#form_'+id_jenis).append(`<div class="col-lg-12 element_${id_jenis}" id="element_${id_jenis}_${id_kendaraan}">
                                                <div class="col-lg-1">
                                                    <input type="text" style="width:40px" name="nomor_kendaraan[${id_jenis}][${id_kendaraan}]" value="">
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_1[${id_jenis}][${id_kendaraan}]" id="search_petugas_1_${id_jenis}_${id_kendaraan}" class="form-control" style="width:100%">
                                                        <option value="" disabled selected>Pilih petugas 1</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                    <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select> 
                                                                                              
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_2[${id_jenis}][${id_kendaraan}]" id="search_petugas_2_${id_jenis}_${id_kendaraan}" class="form-control" style="width:100%">
                                                        <option value="" disabled selected>Pilih petugas 2</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                    <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="icon" id="btn_add_${id_jenis}_${id_kendaraan}" onclick="add_field('${id_jenis}','${id_kendaraan}','${kode_baru}','${txt_jenis}')" style="background-color:transparent;border:none;" title="Tambah data"><img src="assets/img/icon/icon-add.png" alt="" style="width:20px"></button>
                                                    <button type="button" class="icon" id="btn_drop_${id_jenis}_${id_kendaraan}" onclick="drop_field('${id_jenis}','${id_kendaraan}','${kode_baru}','${txt_jenis}')" style="background-color:transparent;border:none;"  title="Hapus data"><img src="assets/img/icon/icon-drop.png" alt="" style="width:20px"></button>
                                                </div>
                                               
                                            </div>`);
                $("#search_petugas_1_"+id_jenis+"_"+id_kendaraan).select2();
                $("#search_petugas_2_"+id_jenis+"_"+id_kendaraan).select2();


        }else{
            $('#form_'+id_jenis).append(`<div class="col-lg-12 element_${id_jenis}" id="element_${id_jenis}_${id_kendaraan}">
                                                <div class="col-lg-1">
                                                    <h5 style="color:white">${kode_baru}</h5>
                                                    <input type="hidden" name="nomor_kendaraan[${id_jenis}][${id_kendaraan}]" value="${kode_baru}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_1[${id_jenis}][${id_kendaraan}]" id="search_petugas_1_${id_jenis}_${id_kendaraan}" class="form-control" style="width:100%">
                                                        <option value="" disabled selected>Pilih petugas 1</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                    <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select> 
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="nama_petugas_2[${id_jenis}][${id_kendaraan}]" id="search_petugas_2_${id_jenis}_${id_kendaraan}" class="form-control" style="width:100%">
                                                        <option value="" disabled selected>Pilih petugas 2</option>
                                                        @foreach($data['petugas'] as $p)
                                                            @if($p->jenis_petugas == $v->jenis_kendaraan_id)
                                                                    <option value="{{$p->nama_petugas}}">{{$p->nama_petugas}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="icon" id="btn_add_${id_jenis}_${id_kendaraan}" onclick="add_field('${id_jenis}','${id_kendaraan}','${kode_baru}','${txt_jenis}')" style="background-color:transparent;border:none;" title="Tambah data"><img src="assets/img/icon/icon-add.png" alt="" style="width:20px"></button>
                                                    <button type="button" class="icon" id="btn_drop_${id_jenis}_${id_kendaraan}" onclick="drop_field('${id_jenis}','${id_kendaraan}','${kode_baru}','${txt_jenis}')" style="background-color:transparent;border:none;"  title="Hapus data"><img src="assets/img/icon/icon-drop.png" alt="" style="width:20px"></button>
                                                </div>
                                               
                                            </div>`);
                $("#search_petugas_1_"+id_jenis+"_"+id_kendaraan).select2();
                $("#search_petugas_2_"+id_jenis+"_"+id_kendaraan).select2();
        }
        
    }

    function drop_field(id_jenis, id_kendaraan){
        var show_id = id_kendaraan-1;
        document.getElementById("element_"+id_jenis+"_"+id_kendaraan).remove();
        document.getElementById("btn_add_"+id_jenis+"_"+show_id).style.display = "block";
        if(show_id>0){
            document.getElementById("btn_drop_"+id_jenis+"_"+show_id).style.display = "block";
        }
        console.log(show_id);
    }

    function update(){
        $.ajax({
            url:"{{url('/update-petugas')}}",
            method:"POST",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $('#update_petugas').serialize(),
            dataType:'json',
            error: function(e){
                console.log(e);
                console.log('Update Petugas Error');
                Swal.fire('Gagal Update Petugas!', '', 'error')
                                // ShowNotif('Forward to TIC Gagal!', 'red');
                            },
            success:function(data)
                            {
                                console.log(data);
                                if(data.status){
                                    Swal.fire('Berhasil Update Petugas!', '', 'success');
                                }
                                else{
                                    Swal.fire(data.data, '', 'error');

                                    // ShowNotif(data.data, 'red');
                                }
                            }
            
        })
    }
    // Swal.fire({
    //     title: 'Success!',
    //     text: 'Berhasil menambahkan!',
    //     icon: 'success',
    //     confirmButtonText: 'Cool'
    //     });
</script>
@endsection