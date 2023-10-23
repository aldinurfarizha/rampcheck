<?php $this->load->view('partials/header.php') ?>
<?php $this->load->view('partials/leftbar.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sopir <i class="fa fa-user"></i></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td><?= $data->nama_sopir ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Lahir</td>
                                            <td><?= $data->tgl_lahir . ' (' . calculateAge($data->tgl_lahir) . ' Tahun)'  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td><?= $data->telepon ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><?= $data->alamat ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bus <i class="fa fa-bus"></i></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nomor Plat Kendaraan</td>
                                            <td><?= $data->nomor_plat_kendaraan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama PO</td>
                                            <td><?= $data->nama_po ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Angkutan</td>
                                            <td><?= $data->jenis_angkutan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Trayek</td>
                                            <td><?= $data->trayek ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kesimpulan <i class="fa fa-address-card"></i></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Penguji</td>
                                            <td><?= $data->nama_penguji . ' | ' . $data->nip_penguji ?></td>
                                        </tr>
                                        <tr>
                                            <td>Penyidik</td>
                                            <td><?= $data->nama_penyidik . ' | ' . $data->nip_penyidik ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Pemeriksaan</td>
                                            <td><?= $data->tanggal_pemeriksaan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><?= convertStatusRampcheck($data->status) ?></td>
                                        </tr>
                                        <?php if ($data->status) { ?>
                                            <tr>
                                                <td>Cetak</td>
                                                <td><a href="<?= base_url('cetak/printout_suratperingatan/' . $data->id_rampcheck) ?>" class="btn btn-sm btn-outline-primary">Surat Peringatan <i class="fa fa-print"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Hasil Rampcheck <i class="fa fa-check-circle"></i></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>I. Unsur Administrasi</h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>kartu Uji Stuk</td>
                                            <td class="text-center"><?= convertStatusAdministrasi($data->kartu_uji_stuk) ?></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>KP Reguler</td>
                                            <td class="text-center"><?= convertStatusAdministrasi($data->kp_reguler) ?></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>KP Cadangan</td>
                                            <td class="text-center"><?= convertStatusAdministrasi($data->kp_cadangan) ?></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>SIM Pengemudi</td>
                                            <td class="text-center"><?= convertStatusSim($data->sim_pengemudi) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <h5>II. Unsur Teknis Utama</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Lampu Utama (Dekat) <br> Lampu Utama (Jauh)</td>
                                                <td>Kanan : <?= convertLampu($data->lampu_dekat_kanan) ?> Kiri :<?= convertLampu($data->lampu_dekat_kiri) ?>
                                                    <br>Kanan : <?= convertLampu($data->lampu_jauh_kanan) ?> Kiri :<?= convertLampu($data->lampu_jauh_kiri) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Lampu Sein (Depan) <br> Lampu Sein (Belakang)</td>
                                                <td>Kanan : <?= convertLampu($data->lampu_sein_depan_kanan) ?> Kiri :<?= convertLampu($data->lampu_sein_depan_kiri) ?>
                                                    <br>Kanan : <?= convertLampu($data->lampu_sein_depan_kanan) ?> Kiri :<?= convertLampu($data->lampu_sein_depan_kiri) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Lampu REM</td>
                                                <td>Kanan: <?= convertLampu($data->lampu_rem_kanan) ?> Kiri :<?= convertLampu($data->lampu_rem_kiri) ?></td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Lampu Mundur</td>
                                                <td>Kanan: <?= convertLampu($data->lampu_mundur_kanan) ?> Kiri :<?= convertLampu($data->lampu_mundur_kiri) ?></td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>Rem Utama</td>
                                                <td><?= convertRem($data->rem_utama) ?></td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>Rem Parkir</td>
                                                <td><?= convertRem($data->rem_parkir) ?></td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>Kondisi Kaca Depan</td>
                                                <td><?= convertKaca($data->kaca_depan) ?></td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>Pintu Utama</td>
                                                <td>Depan :<?= convertRem($data->pintu_utama_depan) ?> Belakang:<?= convertRem($data->pintu_utama_belakang) ?></td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>Ban Depan <br> Ban Belakang</td>
                                                <td>Kanan : <?= convertBan($data->ban_depan_kanan) ?> Kiri :<?= convertBan($data->ban_depan_kiri) ?>
                                                    <br>Kanan : <?= convertBan($data->ban_belakang_kanan) ?> Kiri :<?= convertBan($data->ban_belakang_kiri) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td>Sabuk Keselamatan Pengemudi</td>
                                                <td><?= convertSabuk($data->sabuk_keselamatan) ?></td>
                                            </tr>
                                            <tr>
                                                <td>11.</td>
                                                <td>Pengukur Kecepatan</td>
                                                <td><?= convertSabuk($data->pengukur_kecepatan) ?></td>
                                            </tr>
                                            <tr>
                                                <td>12.</td>
                                                <td>Penghapus Kaca</td>
                                                <td><?= convertSabuk($data->penghapus_kaca) ?></td>
                                            </tr>
                                            <tr>
                                                <td>13.</td>
                                                <td>Pintu Darurat</td>
                                                <td><?= convertDarurat($data->pintu_darurat) ?></td>
                                            </tr>
                                            <tr>
                                                <td>14.</td>
                                                <td>Jendela Darurat</td>
                                                <td><?= convertDarurat($data->jendela_darurat) ?></td>
                                            </tr>
                                            <tr>
                                                <td>15.</td>
                                                <td>Alat Pemecah Kaca</td>
                                                <td><?= convertDarurat($data->alat_pemecah_kaca) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <h5>III. Unsur Teknis Penunjang</h5>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>16.</td>
                                                <td>Lampu Posisi (Depan) <br> Lampu Posisi (Belakang)</td>
                                                <td>Kanan : <?= convertLampu($data->lampu_posisi_depan_kanan) ?> Kiri :<?= convertLampu($data->lampu_posisi_depan_kiri) ?>
                                                    <br>Kanan : <?= convertLampu($data->lampu_posisi_belakang_kanan) ?> Kiri :<?= convertLampu($data->lampu_posisi_belakang_kiri) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>17.</td>
                                                <td>Kaca Spion</td>
                                                <td><?= convertSpion($data->kaca_spion) ?></td>
                                            </tr>
                                            <tr>
                                                <td>18.</td>
                                                <td>Klakson</td>
                                                <td><?= convertSabuk($data->klakson) ?></td>
                                            </tr>
                                            <tr>
                                                <td>19.</td>
                                                <td>Lantai dan Tangga</td>
                                                <td><?= convertLantai($data->lantai_dan_tangga) ?></td>
                                            </tr>
                                            <tr>
                                                <td>20.</td>
                                                <td>Jl.Tempat Duduk penumpang</td>
                                                <td><?= convertSpion($data->jalan_tempat_duduk_penumpang) ?></td>
                                            </tr>
                                            <tr>
                                                <td>21.</td>
                                                <td>Ban Cadangan</td>
                                                <td><?= convertBanCadangan($data->ban_cadangan) ?></td>
                                            </tr>
                                            <tr>
                                                <td>22.</td>
                                                <td>Segitiga Pengaman</td>
                                                <td><?= convertDarurat($data->segitiga_pengaman) ?></td>
                                            </tr>
                                            <tr>
                                                <td>23.</td>
                                                <td>Dongkrak</td>
                                                <td><?= convertDarurat($data->dongkrak) ?></td>
                                            </tr>
                                            <tr>
                                                <td>24.</td>
                                                <td>Pembuka Roda</td>
                                                <td><?= convertDarurat($data->pembuka_roda) ?></td>
                                            </tr>
                                            <tr>
                                                <td>25.</td>
                                                <td>Lampu Senter</td>
                                                <td><?= convertDarurat($data->lampu_senter) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('partials/footer') ?>