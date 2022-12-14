@extends('master')
@section('dashboard-admin')
active
@endsection
@section('content')
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
									
                                    <div class="row">
                                    <div class="table-responsive text-nowrap">
                                    <table id="Laporan" class="table table-hover" style="background-color:#2f0042;border:none;width:100%">
                                            <thead style="color:white">
                                                <tr style="text-align:center">
                                                    <th style="display:none;">Waktu Laporan</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Ruas</th>
                                                    <th>KM</th>
                                                    <th>Jalur</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Status</th>
                                                    <th>Rating Pelanggan</th>
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
            









<!-- Modal EDIT DATA -->
<div class="modal fade" id="showData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_edit_laporan" class="mb-3" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

            <div class="row">
                <div class="col-lg-3">
                <div class="form-group">
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
                    <div class="form-group">
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
                    <div class="form-group">
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
                    <div class="form-group">
                        <label for="editnama" class="form-label">Nama</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Nama"
                            id="editnama" 
                            name="editnama"
                            readonly
                        />
                    </div>
                    <div class="form-group" >
                        <label for="editno_hp" class="form-label">No Handphone</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            placeholder="No Handphone"
                            id="editno_hp" 
                            name="editno_hp"
                            readonly                        
                        />
                    </div>
                    <div class="form-group">
                        <label for="editjenis_mobil" class="form-label">Jenis Mobil</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Jenis Mobil"
                            id="editjenis_mobil" 
                            name="editjenis_mobil"
                            readonly
                        />
                    </div>
                
                    <div class="form-group">
                        <label for="editplat_nomor" class="form-label">Plat Nomor</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Plat Nomor"
                            id="editplat_nomor" 
                            name="editplat_nomor"
                            style="text-transform:uppercase"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="editjenis_kendala" class="form-label">Jenis Kendala</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Plat Nomor"
                            id="editjenis_kendala" 
                            name="editjenis_kendala"
                            readonly                        
                        />                    
                    </div>
                    
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="editruas" class="form-label">Ruas</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Ruas"
                            id="editruas" 
                            name="editruas"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="editkm" class="form-label">KM</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="60:200"
                            id="editkm" 
                            name="editkm"
                            readonly  
                        />
                    </div>
                    
                    <div class="form-group">
                        <label for="editjalur" class="form-label">Jalur</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Jalur"
                            id="editjalur" 
                            name="editjalur"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="editketerangan" class="form-label">Keterangan</label>
                        <textarea 
                            name="editketerangan" 
                            id="editketerangan"
                            rows="10" 
                            class="form-control" 
                            placeholder="Keterangan"
                            readonly>
                        </textarea>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="waktulaporan" class="form-label">Waktu Laporan</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Waktu Laporan"
                            id="waktulaporan" 
                            name="waktulaporan"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="agentcso" class="form-label">Agent CSO</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Agent CSO"
                            id="agentcso" 
                            name="agentcso"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="petugascc" class="form-label">Command Center</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Command Center"
                            id="petugascc" 
                            name="petugascc"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="waktuforwardtic" class="form-label">Waktu Forward ke TIC</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Waktu Forward ke TIC"
                            id="waktuforwardtic" 
                            name="waktuforwardtic"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="petugastic" class="form-label">TIC</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="TIC"
                            id="petugastic" 
                            name="petugastic"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="waktuassignpetugas" class="form-label">Waktu Assign ke Petugas</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Waktu Assign ke Petugas"
                            id="waktuassignpetugas" 
                            name="waktuassignpetugas"
                            readonly                        
                        />                    
                    </div>
                    <div class="form-group">
                        <label for="petugasbantuan" class="form-label">Petugas yang Melakukan Bantuan</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Petugas yang Melakukan Bantuan"
                            id="petugasbantuan" 
                            name="petugasbantuan"
                            readonly                        
                        />                    
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="waktupetugassampai" class="form-label">Waktu Petugas Sampai di Lokasi</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Waktu Petugas Sampai di Lokasi"
                            id="waktupetugassampai" 
                            name="waktupetugassampai"
                            readonly                        
                        />                    
                    </div>

                    <div class="form-group">
                        <label for="ratingpelanggan" class="form-label">Rating Pelanggan</label>
                        <div  id="ratingpelanggan" name="ratingpelanggan">
                        
                            <!-- <span class="fa fa-star checked"></span> -->
                        </div>    
                        
                    </div>

                    <div class="form-group">
                        <label for="saran" class="form-label">Saran</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Saran"
                            id="saran" 
                            name="saran"
                            readonly                        
                        />                    
                    </div>

                    <div class="form-group">
                        <label for="waktulaporanselesai" class="form-label">Waktu Laporan Selesai</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Waktu Laporan Selesai"
                            id="waktulaporanselesai" 
                            name="waktulaporanselesai"
                            readonly                        
                        />                    
                    </div>

                    <!-- <div class="form-group">
                        <label for="totalwaktu" class="form-label">Total Waktu Laporan</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Total Waktu Laporan"
                            id="totalwaktu" 
                            name="totalwaktu"
                            readonly                        
                        />                    
                    </div> -->

                </div>

            </div> 
      </div>
      <div class="modal-footer">
        
    </div>
      
    </div>
</form>
  </div>
</div>
</div>






    <script type="text/javascript">
        
        $(document).ready(function() {
            LoadLaporanAdmin();

            $('#Laporan').on('click', 'tr', function () {
                
                var table = $('#Laporan').DataTable();

                document.getElementById('laporanid').value = table.row( this ).data().laporan_id;
                document.getElementById('priority').value = table.row( this ).data().priority;
                document.getElementById('priorityid').value = table.row( this ).data().priority_id;
                document.getElementById('editnama').value = table.row( this ).data().laporan_name;
                document.getElementById('editno_hp').value = table.row( this ).data().laporan_phone_no;
                document.getElementById('editjenis_mobil').value = table.row( this ).data().laporan_vehicle_category;
                document.getElementById('editplat_nomor').value = table.row( this ).data().laporan_plat_no;
                document.getElementById('editruas').value = table.row( this ).data().ruas_name; 
                document.getElementById('editjenis_kendala').value = table.row( this ).data().kendala;
                document.getElementById('editjalur').value = table.row( this ).data().laporan_jalur;  
                document.getElementById('editkm').value = table.row( this ).data().laporan_km;                 
                document.getElementById('editketerangan').value = table.row( this ).data().laporan_description;

                document.getElementById('waktulaporan').value = table.row( this ).data().laporan_created_timestamp;
                document.getElementById('agentcso').value = table.row( this ).data().cso_id_name;
                document.getElementById('petugascc').value = table.row( this ).data().command_center_id_name;
                
                
                if (table.row( this ).data().laporan_forward_to_tic_timestamp == null){
                    document.getElementById('waktuforwardtic').value = '-';
                }else{
                    document.getElementById('waktuforwardtic').value = table.row( this ).data().laporan_forward_to_tic_timestamp + ' (' +  table.row( this ).data().total_forward_tic + ' Menit)';
                }

                document.getElementById('petugastic').value = table.row( this ).data().tic_id_name;


                if (table.row( this ).data().laporan_forward_to_petugas_timestamp == null){
                    document.getElementById('waktuassignpetugas').value = '-';
                }else{
                    document.getElementById('waktuassignpetugas').value = table.row( this ).data().laporan_forward_to_petugas_timestamp + ' (' +  table.row( this ).data().total_forward_petugas + ' Menit)';
                }


                document.getElementById('petugasbantuan').value = table.row( this ).data().data_petugas_generate;


                if (table.row( this ).data().laporan_petugas_arrived_timestamp == null){
                    document.getElementById('waktupetugassampai').value = '-';
                }else{
                    document.getElementById('waktupetugassampai').value = table.row( this ).data().laporan_petugas_arrived_timestamp + ' (' +  table.row( this ).data().total_petugas_arrived + ' Menit)';
                }




                if (table.row( this ).data().rating_pelanggan == 0){
                    $('#ratingpelanggan').html("");
                    $('#ratingpelanggan').append(`
                        <span>-</span>
                    `);                    
                }else{       
                    let starHtml = "";
                    for (let i = 1; i <= table.row( this ).data().rating_pelanggan; i++) {
                        starHtml = starHtml + '<span class="fa fa-star checked"></span>';
                    }
                    if (table.row( this ).data().rating_pelanggan < 5){
                        for (let i = table.row( this ).data().rating_pelanggan; i < 5; i++) {
                            starHtml = starHtml + '<span class="fa fa-star"></span>';
                        }
                    }
                    // return starHtml;
                    $('#ratingpelanggan').html("");
                    $('#ratingpelanggan').append(starHtml);
                }


                if (table.row( this ).data().laporan_closed_timestamp == null){
                    document.getElementById('waktulaporanselesai').value = '-';
                }else{
                    document.getElementById('waktulaporanselesai').value = table.row( this ).data().laporan_closed_timestamp + ' (' +  table.row( this ).data().total_arrived_close + ' Menit)';
                }


                
                // if (table.row( this ).data().totaltimeminute == null){
                //     document.getElementById('totalwaktu').value = '-';
                // }else{
                //     document.getElementById('totalwaktu').value = table.row( this ).data().totaltimeminute + ' Menit';
                // }


                $('#showData').modal("show");  
            });

        });


        //table cso
        function LoadLaporanAdmin(){
            $.ajax({
                url: "{{url('/LoadLaporanAdmin')}}",
                type: 'GET',
                dataType: 'json',
                error: function(e) {
                    console.log(e);
                },
                success: function(data) {
                    console.log(data.data);
                    $('#Laporan').DataTable({
                        "order":[[0, 'desc']],
                        "destroy": true,
                        "aaData": data.data,
                        "scrollX": true,
                        "bStateSave": true,
                        "columns":[
                            { "data": "laporan_created_timestamp"},
                            { "data": "laporan_name"},
                            { "data": "laporan_phone_no"},
                            { "data": "ruas_name"},
                            { "data": "laporan_km"},
                            { "data": "laporan_jalur"},
                            { "data": "laporan_vehicle_category"},
                            { "data": "laporan_plat_no"},
                            { "data": "status_name"}
                            // { "data": "rating_pelanggan"}
                        ],
                        "columnDefs": [
                            {
                            targets: 0,
                            visible: false,
                            searchable: false,
                            },
                            {
                            "targets": 9,
                            "data": null,
                            "render": function (data, type, row, meta){
                                // console.log(data.rating_pelanggan);
                                let starHtml = "";
                                for (let i = 1; i <= data.rating_pelanggan; i++) {
                                    starHtml = starHtml + '<span class="fa fa-star checked"></span>';
                                }
                                if (data.rating_pelanggan < 5){
                                    for (let i = data.rating_pelanggan; i < 5; i++) {
                                        starHtml = starHtml + '<span class="fa fa-star"></span>';
                                    }
                                }
                                return starHtml;
                            }
                            }
                        ]
                    });
                }
            });

            setTimeout(function () {
                LoadLaporanAdmin();
            }, 3000);
        }
    </script>
@endsection