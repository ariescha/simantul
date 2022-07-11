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
@section('master-petugas')
active
@endsection
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                    
                            <div class="row">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-petugas">Tambah Petugas</button><br><br><br>
                                <div class="table-responsive text-nowrap">
                                    <table id="Petugas" class="table table-hover" style="background-color:#2f0042;color:white;border:none; width:100%">
                                        <thead>
                                            <tr style="text-align:center">
                                                <th>NIK Petugas</th>
                                                <th>Nama Petugas</th>
                                                <th>Ruas</th>
                                                <th>Spesialisasi</th>
                                                <th>Aksi</th>
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
<div class="modal fade" id="modal-edit-petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Edit Petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="form-edit-petugas" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="row">
                <input type="hidden" class="form-control" id="nik_petugas" name="nik_petugas">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="edit_nik_petugas">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" id="edit_nik_petugas" name="edit_nik_petugas">
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_petugas">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama_petugas" name="edit_nama_petugas">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="edit_spesialisasi">Spesialisasi Kendaraan</label>
                            <select name="edit_spesialisasi" id="edit_spesialisasi" class="form-control">
                                <option value="" disabled>Pilih jenis kendaraan</option>
                                @foreach($kendaraan as $k)
                                <option value="{{$k->jenis_kendaraan_id}}">{{$k->jenis_kendaraan}}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="edit_ruas">Ruas</label>
                            <select name="edit_ruas" id="edit_ruas" class="form-control">
                                <option value="" disabled>Pilih ruas</option>
                                @foreach($ruas as $r)
                                <option value="{{$r->ruas_id}}">{{$r->ruas_name}}</option>
                                @endforeach
                            </select> 
                        </div>

                    </div>
                </div>
            </form>
                
                <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="editPetugasPost()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-tambah-petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Tambah Petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="form-tambah-petugas" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tambah_nik_petugas">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" id="tambah_nik_petugas" name="tambah_nik_petugas">
                        </div>
                        <div class="form-group">
                            <label for="tambah_nama_petugas">Nama Lengkap</label>
                            <input type="text" class="form-control" id="tambah_nama_petugas" name="tambah_nama_petugas">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tambah_spesialisasi">Spesialisasi Kendaraan</label>
                            <select name="tambah_spesialisasi" id="tambah_spesialisasi" class="form-control">
                                <option value="" disabled selected>Pilih jenis kendaraan</option>
                                @foreach($kendaraan as $k)
                                <option value="{{$k->jenis_kendaraan_id}}">{{$k->jenis_kendaraan}}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="tambah_ruas">Ruas</label>
                            <select name="tambah_ruas" id="tambah_ruas" class="form-control">
                                <option value="" disabled selected>Pilih ruas</option>
                                @foreach($ruas as $r)
                                <option value="{{$r->ruas_id}}">{{$r->ruas_name}}</option>
                                @endforeach
                            </select> 
                        </div>

                    </div>
                </div>
            </form>
                
                <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="tambahPetugasPost()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div style="visibility:hidden">
    <form action="" id="form-drop-petugas" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        <input type="hidden" id="drop_nik_petugas" name="drop_nik_petugas">
    </form>
</div>

    <script type="text/javascript">
        var old_row = 0;

        function editPetugas(nik,nama,ruas,spesialisasi){
           console.log(nik,nama,ruas,spesialisasi);
           document.getElementById('nik_petugas').value = nik;

            document.getElementById('edit_nik_petugas').value = nik;
            document.getElementById('edit_nama_petugas').value = nama;
            document.getElementById('edit_ruas').value = ruas;
            document.getElementById('edit_spesialisasi').value = spesialisasi;

            $('#modal-edit-petugas').modal('show');

        }
        function tambahPetugasPost(){
            console.log('Forward to TIC')
            $('#modal-tambah-petugas').modal('hide');
            $.ajax({
                url:"{{url('/tambahPetugas')}}",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#form-tambah-petugas').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    console.log('Forward to TIC Error');
                    Swal.fire('Gagal Menambah Data Petugas!', '', 'error')
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.status){
                        Swal.fire('Berhasil Menambah Data Petugas!', '', 'success');
                        LoadPetugas();
                    }
                    else{
                        ShowNotif(data.data, 'red');
                    }
                }
            })                        
        }

        function editPetugasPost(){
            console.log('Forward to TIC')
            $('#modal-edit-petugas').modal('hide');
            $.ajax({
                url:"{{url('/EditPetugas')}}",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#form-edit-petugas').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    console.log('Forward to TIC Error');
                    Swal.fire('Gagal Mengubah Data Petugas!', '', 'error')
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.status){
                        Swal.fire('Berhasil Mengubah Data Petugas!', '', 'success');
                        LoadPetugas();
                    }
                    else{
                        ShowNotif(data.data, 'red');
                    }
                }
            })                        
        }      

        function dropPetugas(nik,nama){
            document.getElementById("drop_nik_petugas").value=nik;
                Swal.fire({
                    title: "Apakah anda yakin",
                    text: "Ingin menghapus petugas "+nama+"?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    console.log(result);
                    if(result['value'] == true){
                        $.ajax({
                            url:"{{url('/dropPetugas')}}",
                            method:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:$('#form-drop-petugas').serialize(),
                            dataType:'json',
                            error: function(e) {
                                console.log(e);
                                console.log('Forward to TIC Error');
                                Swal.fire('Gagal menghapus '+nama+'!', '', 'error')
                                // ShowNotif('Forward to TIC Gagal!', 'red');
                            },
                            success:function(data)
                            {
                                console.log(data);
                                if(data.status){
                                    Swal.fire('Berhasil menghapus '+nama+'!', '', 'success');
                                    LoadPetugas();
                                    
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
            LoadPetugas();
        });

        function LoadPetugas(){
            // $('loader').show();
            console.log('LoadPetugas');
            $.ajax({
                url: "{{url('/LoadPetugas')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                    
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Petugas').DataTable({
                        "destroy": true,
                        "aaData": data.data,
                        "order": [[0, 'desc'],[1,'asc']],
                        "scrollX": true,
                        "columns":[
                            { "data": "nik_petugas"},
                            { "data": "nama_petugas"},
                            { "data": "ruas_name"},
                            { "data": "jenis_kendaraan"},
                        ],
                        "columnDefs": [
                            {"targets": 4,
                            "data": null,
                            "render": function (data, type, row, meta){
                                return '<button id="edit-petugas" class="btn rounded-pill btn-sm btn-warning" onclick="editPetugas(`'+row.nik_petugas+'`,`'+row.nama_petugas+'`,`'+row.ruas_id+'`,`'+row.jenis_kendaraan_id+'`)" title="Edit Petugas"><i class="fa fa-pencil"></i></button> <button id="drop-petugas" class="btn rounded-pill btn-sm btn-danger" onclick="dropPetugas(`'+row.nik_petugas+'`,`'+row.nama_petugas+'`)" title="Hapus Petugas"><i class="fa fa-trash"></i></button>';}
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
                LoadPetugas();
            }, 3000);

        }
    </script>
@endsection