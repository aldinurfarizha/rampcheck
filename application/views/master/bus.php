<?php $this->load->view('partials/header.php') ?>
<?php $this->load->view('partials/leftbar.php') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master - BUS <i class="fa fa-bus"></i></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data BUS Terdaftar</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Kendaraan</th>
                            <th>Nama PO</th>
                            <th>Jenis Angkutan</th>
                            <th>Trayek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $datar) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td class="font-weight-bold text-center"><a href="<?= base_url('master/detail_bus/' . $datar->id_bus) ?>"><?= $datar->nomor_plat_kendaraan ?></a></td>
                                <td><?= $datar->nama_po ?></td>
                                <td><?= $datar->jenis_angkutan ?></td>
                                <td><?= $datar->trayek ?></td>
                                <td class="text-center">
                                    <button onclick="fillEdit('<?= $datar->id_bus ?>','<?= $datar->nomor_plat_kendaraan ?>','<?= $datar->nama_po ?>','<?= $datar->jenis_angkutan ?>','<?= $datar->trayek ?>')" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="hapus('<?= $datar->id_bus ?>')" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Plat Kendaraan</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                    <input type="text" id="add_initial_start" placeholder="E" maxlength="2" style="text-transform:uppercase" onkeydown="return /[a-z]/i.test(event.key)" name="initial_start" class="form-control text-center">
                                    </div>
                                    <div class="col-sm-8">
                                    <input type="text" id="add_number" placeholder="1234" maxlength="4" onkeydown="return /[0-9]/i.test(event.key) || event.key === 'Backspace' || event.key === 'Delete'" name="number" class="form-control text-center">
                                    </div>
                                    <div class="col-sm-2">
                                    <input type="text" id="add_initial_end" placeholder="YAH" maxlength="3" style="text-transform:uppercase" onkeydown="return /[a-z]/i.test(event.key)" name="initial_end" class="form-control text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama PO</label>
                                <input type="text" id="add_nama_po" class="form-control" name="nama_po" placeholder="Misal:Sehati">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jenis Angkutan</label>
                                <select name="jenis_angkutan" id="add_jenis_angkutan" class="form-control">
                                    <option value="">--Pilih Jenis Angkutan--</option>
                                    <option value="AKAP">AKAP</option>
                                    <option value="AKDP">AKDP</option>
                                    <option value="PARIWISATA">PARIWISATA</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Trayek</label>
                                <input type="text" id="add_trayek" class="form-control" name="trayek" placeholder="Misal:Kuningan-Jakarta">
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="button" id="btn-add" onclick="simpan()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Plat Kendaraan</label>
                                <input type="hidden" name="id_bus" id="id_bus">
                                <input type="text" style="cursor: not-allowed;  " readonly id="nomor_plat_kendaraan" class="form-control">
                                <small class="text-muted">*Tidak Bisa di ubah</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama PO</label>
                                <input type="text" class="form-control" name="nama_po" id="nama_po" placeholder="Misal:Sehati">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jenis Angkutan</label>
                                <select name="jenis_angkutan" id="jenis_angkutan" class="form-control">
                                    <option value="">--Pilih Jenis Angkutan--</option>
                                    <option value="AKAP">AKAP</option>
                                    <option value="AKDP">AKDP</option>
                                    <option value="PARIWISATA">PARIWISATA</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Trayek</label>
                                <input type="text" class="form-control" name="trayek" id="trayek" placeholder="Misal:Kuningan-Jakarta">
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="button" id="btn-edit" onclick="edit()" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('partials/footer') ?>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function keyDown(e) {
        var e = window.event || e;
        var key = e.keyCode;
        //space pressed
        if (key == 32) { //space
            e.preventDefault();
        }
        if (key == 186) { //semicolon
            e.preventDefault();
        }
        if (key == 187) { //comma
            e.preventDefault();
        }
        if (key == 221) { //comma
            e.preventDefault();
        }
        if (key == 222) { //comma
            e.preventDefault();
        }
        if (key == 219) { //comma
            e.preventDefault();
        }
    }

    function Addvalidation() {
        if ($("#add_initial_start").val() == "") {
            alertMessage("Kolom Ini tidak boleh kosong");
            return false;
        }
        if ($("#add_number").val() == "") {
            alertMessage("Kolom Ini tidak boleh kosong");
            return false;
        }
        if ($("#add_initial_end").val() == "") {
            alertMessage("Kolom Ini tidak boleh kosong");
            return false;
        }
        if ($('#add_nama_po').val() == "") {
            alertMessage("Nama PO tidak boleh kosong");
            return false;
        }
        if ($('#add_jenis_angkutan').find(":selected").val() == "") {
            alertMessage("Jenis Angkutan Harus di pilih terlebih dahulu !");
            return false;
        }
        if ($('#add_trayek').val() == "") {
            alertMessage("Trayek tidak boleh kosong");
            return false;
        }
        return true;
    }

    function editValidation() {
        if ($("#nomor_plat_kendaraan").val() == "") {
            alertMessage("Nomor Plat Kendaraan tidak boleh kosong");
            return false;
        }
        if ($('#nama_po').val() == "") {
            alertMessage("Nama PO tidak boleh kosong");
            return false;
        }
        if ($('#jenis_angkutan').find(":selected").val() == "") {
            alertMessage("Jenis Angkutan Harus di pilih terlebih dahulu !");
            return false;
        }
        if ($('#trayek').val() == "") {
            alertMessage("Trayek tidak boleh kosong");
            return false;
        }
        return true;
    }

    function simpan() {
        if (!Addvalidation()) {
            return false;
        }
        $.ajax({
            url: "<?= base_url('master/add_bus') ?>",
            type: "POST",
            data: $('#form-add').serialize(),
            beforeSend() {
                $("#btn-add").attr("disabled", true);
                loading();
            },
            success: function(response) {
                $("#btn-add").attr("disabled", false);
                success();
            },
            error: function(response) {
                $("#btn-add").attr("disabled", false);
                Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button: "Oke",
                    text: response.responseJSON.messages
                }).then(function() {})
            }
        });
    }

    function edit() {
        if (!editValidation()) {
            return false;
        }
        $.ajax({
            url: "<?= base_url('master/edit_bus') ?>",
            type: "POST",
            data: $('#form-edit').serialize(),
            beforeSend() {
                $("#btn-edit").attr("disabled", true);
                loading();
            },
            success: function(response) {
                $("#btn-edit").attr("disabled", false);
                success();
            },
            error: function(response) {
                $("#btn-edit").attr("disabled", false);
                Swal.fire({
                    icon: "error",
                    title: 'Opps!',
                    button: "Oke",
                    text: response.responseJSON.messages
                }).then(function() {})
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            icon: 'question',
            title: 'Hapus',
            text: 'Semua data RAMPCHECK yang mempunyai relasi dengan BUS ini akan ikut terhapus!',
            showConfirmButton: true,
            showCancelButton: true,
            showBackdrop: true,
            confirmButtonText: 'Ya Hapus',
            cancelButtonText: 'Tidak'
        }).then(function(data) {
            if (data.value === true) {
                $.ajax({
                    url: "<?= base_url('master/delete_bus') ?>",
                    type: "POST",
                    data: {
                        "id": id,
                    },
                    beforeSend() {
                        loading();
                    },
                    success: function(response) {
                        success();
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: "error",
                            title: 'Opps!',
                            button: "Oke",
                            text: response.responseJSON.messages
                        }).then(function() {})
                    }
                });
            }
        });
    };

    function fillEdit(id_bus, nomor_plat_kendaraan, nama_po, jenis_angkutan, trayek) {
        $('#editModal').modal('show');
        $('#id_bus').val(id_bus);
        $('#nomor_plat_kendaraan').val(nomor_plat_kendaraan);
        $('#nama_po').val(nama_po);
        $('#trayek').val(trayek);
        var option = "<option value=" + jenis_angkutan + " selected='true'>" + jenis_angkutan + "</option>"
        $('#jenis_angkutan').append(option);
    }
</script>