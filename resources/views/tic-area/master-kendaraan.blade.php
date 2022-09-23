@extends('master')
<style>
    .redRow,
    .redRow:hover {
        background-color: #F5413D !important;
    }

    .orangeRow,
    .orangeRow:hover {
        background-color: orange !important;
        color: black !important;

    }
</style>
@section('master-kendaraan')
active
@endsection
@section('content')

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">

                    <div class="row">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-petugas" onclick="resetForm()">Tambah Kendaraan</button><br><br><br>
                        <div class="table-responsive text-nowrap">
                            <table id="dataTable" class="table table-hover" style="background-color:#2f0042;color:white;border:none; width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Nomor</th>
                                        <th>Ruas</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($record as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->jenis_kendaraan->jenis_kendaraan}}</td>
                                        <td>{{$item->kendaraan_nomor}}</td>
                                        <td>{{$item->ruas->ruas_name}}</td>
                                        <td>{{$item->status == 1 ? 'Aktif' : 'Non Aktif' }}</td>
                                        <td>{{$item->created_at->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach
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
                            <h4 class="modal-title" id="exampleModalLongTitle">Tambah Kendaraan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-tambah-petugas" method="post" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Jenis Kendaraan</label>
                                            <select name="kendaraan_jenis" id="kendaraan_jenis" class="form-control">
                                                <option value="">Pilih Jenis Kendaraan</option>
                                                @foreach ($jenis_kendaraan as $item)
                                                <option value="{{$item->jenis_kendaraan_id}}">{{$item->jenis_kendaraan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nomor</label>
                                            <input type="text" class="form-control" id="kendaraan_nomor" name="kendaraan_nomor">
                                        </div>
                                        <div class="form-group">
                                            <label for="tambah_nama_petugas">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Pilih Status</option>
                                                <option selected value="1">Aktif</option>
                                                <option value="0">Non Aktif</option>
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

                function resetForm() {
                    document.getElementById("form-tambah-petugas").reset();
                }

                function editPetugas(nik, nama, ruas, spesialisasi) {
                    console.log(nik, nama, ruas, spesialisasi);
                    document.getElementById('nik_petugas').value = nik;

                    document.getElementById('edit_nik_petugas').value = nik;
                    document.getElementById('edit_nama_petugas').value = nama;
                    document.getElementById('edit_ruas').value = ruas;
                    document.getElementById('edit_spesialisasi').value = spesialisasi;

                    $('#modal-edit-petugas').modal('show');

                }

                function tambahPetugasPost() {
                    console.log('Forward to TIC')
                    var data = $('#form-tambah-petugas').serialize();
                    console.log(data);
                    $.ajax({
                        url: "{{url('master-kendaraan')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: $('#form-tambah-petugas').serialize(),
                        dataType: 'json',
                        error: function(e) {
                            console.log(e);
                            console.log('Forward to TIC Error');
                            Swal.fire('Gagal Menambah Data Petugas!', '', 'error')
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire('Berhasil Menambah Data Petugas!', '', 'success');
                            location.reload(true);
                        }
                    })
                }

                function editPetugasPost() {
                    console.log('Forward to TIC')
                    $('#modal-edit-petugas').modal('hide');
                    $.ajax({
                        url: "{{url('/EditPetugas')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: $('#form-edit-petugas').serialize(),
                        dataType: 'json',
                        error: function(e) {
                            console.log(e);
                            console.log('Forward to TIC Error');
                            Swal.fire('Gagal Mengubah Data Petugas!', '', 'error')
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status) {
                                Swal.fire('Berhasil Mengubah Data Petugas!', '', 'success');
                                LoadPetugas();
                            } else {
                                Swal.fire(data.data, '', 'error');

                                // ShowNotif(data.data, 'red');
                            }
                        }
                    })
                }

                function dropPetugas(nik, nama) {
                    document.getElementById("drop_nik_petugas").value = nik;
                    Swal.fire({
                        title: "Apakah anda yakin",
                        text: "Ingin menghapus petugas " + nama + "?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: `Tidak`,
                    }).then((result) => {
                        console.log(result);
                        if (result['value'] == true) {
                            $.ajax({
                                url: "{{url('/dropPetugas')}}",
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: $('#form-drop-petugas').serialize(),
                                dataType: 'json',
                                error: function(e) {
                                    console.log(e);
                                    console.log('Forward to TIC Error');
                                    Swal.fire('Gagal menghapus ' + nama + '!', '', 'error')
                                    // ShowNotif('Forward to TIC Gagal!', 'red');
                                },
                                success: function(data) {
                                    console.log(data);
                                    if (data.status) {
                                        Swal.fire('Berhasil menghapus ' + nama + '!', '', 'success');
                                        LoadPetugas();

                                    } else {
                                        ShowNotif(data.data, 'red');
                                    }
                                }
                            })
                            // Swal.fire('Berhasil Diteruskan Ke TIC Area!', '', 'success');
                        }
                    });
                }

                // $(document).ready(function() {
                //     $('#dataTable').DataTable({
                //         processing: true,
                //         serverSide: true,
                //         "ajax": {
                //             "url": "{{url('master-kendaraan/grid')}}",
                //             "type": "POST",
                //             dataSrc:"",
                //             'data': function (d) {
                //                 d._token = "{{ csrf_token() }}"
                //             }
                //         },
                //         columns: [
                //             { data: 'kendaraan_id' },
                //             { data: 'kendaraan_jenis' },
                //             { data: 'kendaraan_nomor' },
                //             { data: 'ruas_id' },
                //             { data: 'status' },
                //             { data: 'created_at' },
                //         ],
                //     });
                // });
            </script>
            @endsection