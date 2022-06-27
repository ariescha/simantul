@extends('master')
<style>
    .redRow{
        background-color:red !important;
    }
    .orangeRow{
        background-color: orange !important;
    }
</style>
<?php $user_id = Session::get('user_id'); ?>
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
									<div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-7">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPermintaan">+ Tambah Data</button>
                                    
                                            </div>
                                            <div class="col-lg-5">
                                            <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading  pull-right">
                                                <form role="search" class="">
													<a href=""><i class="fa fa-search"></i></a>
													<input type="text" placeholder="Pencarian..." class="form-control">
												</form>
                                            </div></div></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                    <div class="table-responsive text-nowrap">
                                    <table id="Laporan" class="table table-hover" style="background-color:white;width:100%">
                                            <thead style="color:black">
                                                <tr style="text-align:center">
                                                    <th style="display:none;">Status Prioritas</th>
                                                    <th>Waktu Laporan</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Jenis Kendala</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Ruas</th>
                                                    <th>Jalur</th>
                                                    <th>KM</th>
                                                    <th>Keterangan</th>
                                                    <!-- <th>id</th> -->
                                                </tr>
                                            </thead>
                                            <tbody style="color:black">
                                                <tr class="separator" style="height:5px"></tr>
                                                <tr style="background-color:#370c4a;text-align:center"></tr>
                                                
                                            </tbody>
                                        </table>     
                                </div>
                        </div>    
                    </div>
                </div>
            </div>
            


<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahPermintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="width:700px"role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Permintaan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_add_laporan" class="mb-3" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Nama"
                            id="nama" 
                            name="nama"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Nama!')" oninput="this.setCustomValidity('')"
                        />
                    </div>
                    <div class="form-group" >
                        <label for="no_hp" class="form-label">No Handphone</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            placeholder="No Handphone"
                            id="no_hp" 
                            name="no_hp"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi No Handphone!')" oninput="this.setCustomValidity('')"
                        />
                    </div>

                    <div class="form-group">
                        <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Jenis Mobil"
                            id="jenis_mobil" 
                            name="jenis_mobil"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Jenis Mobil!')" oninput="this.setCustomValidity('')"
                        />
                    </div> </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="plat_nomor" class="form-label">Plat Nomor</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Plat Nomor"
                            id="plat_nomor" 
                            name="plat_nomor"
                            style="text-transform:uppercase"
                            oninput="this.value = this.value.toUpperCase()"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Plat Nomor!')" oninput="this.setCustomValidity('')"
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="ruas" class="form-label">Ruas</label>
                        <select name="ruas" id="ruas" class="form-control" required>
                            <option value="" disabled selected>Pilih Ruas</option>
                            @foreach($managementRuas as $p)
                            <option value="{{ $p->ruas_id }}">{{ $p->ruas_name }}</option>
		                    @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kendala" class="form-label">Jenis Kendala</label>
                        <select name="jenis_kendala" id="jenis_kendala" class="form-control" required>
                            <option value="" disabled selected>Pilih Kendala</option>
                            @foreach($managementJenisKendala as $p)
                            <option value="{{ $p->kendala_id }}">{{ $p->kendala }}</option>
		                    @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jalur" class="form-label">Jalur</label>
                        <select name="jalur" id="jalur" class="form-control" required>
                            <option value="" disabled selected>Pilih Jalur</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="km" class="form-label">KM</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="60:200"
                            id="km" 
                            name="km"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi KM!')" oninput="this.setCustomValidity('')"
                        />
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea 
                            name="keterangan" 
                            id="keterangan" 
                            cols="30" 
                            rows="10" 
                            class="form-control"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Keterangan!')" oninput="this.setCustomValidity('')">
                        </textarea>
                    </div>
                </div>

            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addData()">Tambah Data</button>
      </div>
    </div>
</form>
  </div>
</div>
</div>






<!-- Modal EDIT DATA -->
<div class="modal fade" id="editPermintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Permintaan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_edit_laporan" class="mb-3" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

            <div class="row">
                <div class="col-lg-6">
                <div class="row">
                        <label for="laporanid" class="form-label">Laporan ID</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Laporan ID"
                            id="laporanid" 
                            name="laporanid"
                            readonly
                        />
                    </div>
                    <div class="row">
                        <label for="priority" class="form-label">Prioritas</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Prioritas"
                            id="priority" 
                            name="priority"
                            readonly
                        />
                    </div>
                    <div class="row">
                        <!-- <label for="priorityid" class="form-label">Prioritas</label> -->
                        <input 
                            type="hidden" 
                            class="form-control" 
                            placeholder="Prioritas"
                            id="priorityid" 
                            name="priorityid"
                            readonly
                        />
                    </div>
                    <div class="row">
                        <label for="editnama" class="form-label">Nama</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Nama"
                            id="editnama" 
                            name="editnama"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Nama!')" oninput="this.setCustomValidity('')"
                        />
                    </div>
                    <div class="row" >
                        <label for="editno_hp" class="form-label">No Handphone</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            placeholder="No Handphone"
                            id="editno_hp" 
                            name="editno_hp"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi No Handphone!')" oninput="this.setCustomValidity('')"
                        />
                    </div>
                    <div class="row">
                        <label for="editjenis_mobil" class="form-label">Jenis Mobil</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Jenis Mobil"
                            id="editjenis_mobil" 
                            name="editjenis_mobil"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Jenis Mobil!')" oninput="this.setCustomValidity('')"
                        />
                    </div>
                <div class="col-lg-6">
                    <div class="row">
                        <label for="editplat_nomor" class="form-label">Plat Nomor</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Plat Nomor"
                            id="editplat_nomor" 
                            name="editplat_nomor"
                            style="text-transform:uppercase"
                            oninput="this.value = this.value.toUpperCase()"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Plat Nomor!')" oninput="this.setCustomValidity('')"
                        />                    
                    </div>
                    <div class="row">
                        <label for="editruas" class="form-label">Ruas</label>
                        <select name="editruas" id="editruas" class="form-control" required>
                            <option value="" disabled selected>Pilih Ruas</option>
                            @foreach($managementRuas as $p)
                            <option value="{{ $p->ruas_id }}">{{ $p->ruas_name }}</option>
		                    @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <label for="editjenis_kendala" class="form-label">Jenis Kendala</label>
                        <select name="editjenis_kendala" id="editjenis_kendala" class="form-control" required>
                            <option value="" disabled selected>Pilih Kendala</option>
                            @foreach($managementJenisKendala as $p)
                            <option value="{{ $p->kendala_id }}">{{ $p->kendala }}</option>
		                    @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <label for="editjalur" class="form-label">Jalur</label>
                        <select name="editjalur" id="editjalur" class="form-control" required>
                            <option value="" disabled selected>Pilih Jalur</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="row">
                        <label for="editkm" class="form-label">KM</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="60:200"
                            id="editkm" 
                            name="editkm"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi KM!')" oninput="this.setCustomValidity('')"
                        />
                    </div>
                    <div class="row">
                        <label for="editketerangan" class="form-label">Keterangan</label>
                        <textarea 
                            name="editketerangan" 
                            id="editketerangan" 
                            cols="30" 
                            rows="10" 
                            class="form-control" 
                            placeholder="Keterangan"
                            required 
                            oninvalid="this.setCustomValidity('Silakan isi Keterangan!')" oninput="this.setCustomValidity('')">
                        </textarea>
                    </div>
                </div>

            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="editData()">Simpan</button>
        
        <button type="button" class="btn btn-primary" onclick="changePriority()">Up-Prioritas</button>
    </div>
      
    </div>
</form>
  </div>
</div>
</div>








    <script type="text/javascript">
        
        $(document).ready(function() {
            LoadLaporanCso();

            

            $('#Laporan').on('click', 'tr', function () {

                var table = $('#Laporan').DataTable();

                document.getElementById('laporanid').value = table.row( this ).data().laporan_id;
                document.getElementById('priority').value = table.row( this ).data().priority;
                document.getElementById('priorityid').value = table.row( this ).data().priority_id;
                document.getElementById('editnama').value = table.row( this ).data().laporan_name;
                document.getElementById('editno_hp').value = table.row( this ).data().laporan_phone_no;
                document.getElementById('editjenis_mobil').value = table.row( this ).data().laporan_vehicle_category;
                document.getElementById('editplat_nomor').value = table.row( this ).data().laporan_plat_no;
                document.getElementById('editruas').value = table.row( this ).data().laporan_ruas_id; 
                document.getElementById('editjenis_kendala').value = table.row( this ).data().laporan_problem_category;
                document.getElementById('editjalur').value = table.row( this ).data().laporan_jalur;  
                document.getElementById('editkm').value = table.row( this ).data().laporan_km;                 
                document.getElementById('editketerangan').value = table.row( this ).data().laporan_description;
                

                $('#editPermintaan').modal("show");  
            });

        });


        function addData(){
            $.ajax({
                url:"{{url('/add-laporan')}}",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#form_add_laporan').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    Swal.fire('Gagal Input Data Laporan', '', 'error')
                },
                success:function(data){
                    console.log(data);
                    if(data.status){
                        $('#tambahPermintaan').modal('hide');
                        document.getElementById("form_add_laporan").reset();
                        Swal.fire('Berhasil Input Data Laporan', '', 'success');                            
                        // LoadLaporanCso();
                    }else{
                        ShowNotif(data.data, 'red');
                        }
                }
            })  
        }

        function changePriority(){
            
            $.ajax({
                url:"{{url('/change-priority')}}",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#form_edit_laporan').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    Swal.fire('Gagal Edit Prioritas', '', 'error')
                },
                success:function(data){
                    console.log(data);
                    if(data.status){
                        $('#editPermintaan').modal('hide');
                        // document.getElementById("form_add_laporan").reset();
                        Swal.fire('Berhasil Edit Prioritas', '', 'success');                            
                        // LoadLaporanCso();
                    }else{
                        ShowNotif(data.data, 'red');
                        }
                }
            })  
        }

        function editData(){
            // var isinya = $('#form_edit_laporan').serialize();
            // console.log(isinya);
            
            $.ajax({
                url:"{{url('/edit-laporan')}}",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#form_edit_laporan').serialize(),
                dataType:'json',
                error: function(e) {
                    console.log(e);
                    Swal.fire('Gagal Edit Data Laporan', '', 'error')
                },
                success:function(data){
                    console.log(data);
                    if(data.status){
                        $('#editPermintaan').modal('hide');
                        // document.getElementById("form_add_laporan").reset();
                        Swal.fire('Berhasil Edit Data Laporan', '', 'success');                            
                        // LoadLaporanCso();
                    }else{
                        ShowNotif(data.data, 'red');
                        }
                }
            })  
        }

        //table cso
        function LoadLaporanCso(){
            console.log('LoadLaporanCso');
            $.ajax({
                url: "{{url('/LoadLaporanCso')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Laporan').DataTable({
                        "order":[[0, 'desc'],[1,'desc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "columns":[
                            { "data": "priority_id"},
                            { "data": "laporan_created_timestamp"},
                            { "data": "laporan_name"},
                            { "data": "laporan_phone_no"},
                            { "data": "laporan_vehicle_category"},
                            { "data": "kendala"},
                            { "data": "laporan_plat_no"},
                            { "data": "ruas_name"},
                            { "data": "laporan_jalur"},
                            { "data": "laporan_km"},
                            { "data": "laporan_description"}
                        ],
                        columnDefs: [
                        {
                            targets: 0,
                            visible: false,
                            searchable: false,
                        }],
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
                LoadLaporanCso();
            }, 30000);
        }
    </script>
@endsection