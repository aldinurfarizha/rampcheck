<html lang="en" class="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Bookman Old Style", serif;
        }

        p {
            font-size: 9.5pt;
        }

        .item {
            margin-bottom: -15px;
            margin-left: 50px;
        }

        .justify {
            text-align: justify;
        }

        .right {
            text-align: right;
        }

        .footer {
            color: darkgray;
            font-size: 7pt;
        }

        .border {
            border: 1px solid black;
            border-radius: 10px;
        }
    </style>
    <title>Cetak - Surat Peringatan</title>
</head>

<body>
    <img width="100%" src="<?= base_url('assets/img/kop.png') ?>" alt="">
    <br>

    <center>
        <h3 style="margin : 0; padding-top:0;"><U><B> BERITA ACARA PEMERIKSAAN</B></U></h3>
        <h4 style="margin : 0; padding-top:0;">Nomor:<?= @$rampcheck->id_rampcheck ?>/Term.A-KNG/SP/<?= date('Y') ?></h4>
    </center>
    <p>Pada hari ini <?= terbilangHari($rampcheck->tanggal_pemeriksaan) ?> tanggal <?= getTanggal($rampcheck->tanggal_pemeriksaan) ?> bulan <?= terbilangBulan($rampcheck->tanggal_pemeriksaan) ?> tahun <?= getTahun($rampcheck->tanggal_pemeriksaan) ?> jam <?= getJam($rampcheck->tanggal_pemeriksaan) ?> WIB, kami telah melakukan pemeriksaan terhadap BUS PO <?= $rampcheck->nama_po ?> dengan data sebagai berikut:</p>
    <table>
        <tr>
            <td>Nomor Kendaraan</td>
            <td>:<?= $rampcheck->nomor_plat_kendaraan ?></td>
        </tr>
        <tr>
            <td>Nomor Uji</td>
            <td>:<?= $rampcheck->id_rampcheck ?></td>
        </tr>
        <tr>
            <td>Trayek / Jurusan</td>
            <td>:<?= $rampcheck->trayek ?></td>
        </tr>
    </table>
    <p>Yang di kemudikan oleh :</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>:<?= $rampcheck->nama_sopir ?></td>
        </tr>
        <tr>
            <td>Tanggal lahir</td>
            <td>:<?= $rampcheck->tgl_lahir ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:<?= $rampcheck->alamat ?></td>
        </tr>
    </table>
    <br>
    <p>
        Berdasarkan hasil pemeriksaan bahwa kendaraan tersebut tidak memenuhi Persyaratan Administrasi / Teknis dan laik jalan, karena terdapat masalah pada: </p>
    <br>
    <?php
    $no = 1;
    $array = get_object_vars($rampcheck);
    foreach ($array as $key => $value) {
        if ($value == 2 || $value == 3 && $key != 'id_sopir') {
            $result = ubahFormat("$no. $key<br>");
            echo '<p style="margin : 0; padding-top:0;">' . $result . '</p>';
            $no++;
        }
    }
    ?>

    <br>
    <p>Sehubungan hal tersebut diatas, maka dengan ini kendaraan tersebut <b>TIDAK DIIZINKAN BERANGKAT ( OPERASIONAL ) </b> untuk meneruskan perjalanan dan kepada Pengemudi kami perintahkan agar kembali ke Pool / Garasi untuk memperbaiki kekurangan-kekurangan tersebut diatas.</p>
    <p align="right">Kuningan, <?= date('Y-m-d') ?></p>
    <table width="100%">
        <tr>
            <td>Menyetujui untuk kembali ke Pool / Garasi</td>
        </tr>
        <tr>
            <td>
                <center>
                    <b>Pengemudi</b>
                </center>
            </td>
            <td>
                <center><b>Penyidik Pegawai Negeri Sipil <br> (PPNS)</b></center>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <center><img width="250px" style="margin-top: 35px;" src="<?= base_url('assets/img/ttd.jpg') ?>"></center>
            </td>
        </tr>
        <tr>
            <td>
                <center><b><u><?= $rampcheck->nama_sopir ?></u></b></center>
            </td>
            <td>
                <center><b><u><?= $rampcheck->nama_penyidik ?></u></b></center>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <center><?= $rampcheck->nip_penyidik ?></center>
            </td>
        </tr>
    </table>
    <p><u>Keterangan :</u></p>
    <p style="margin : 0; padding-top:0;">- Lembar 1 Untuk Pengemudi / Pemilik Barang</p>
    <p style="margin : 0; padding-top:0;">- Lembar 2 Untuk Penyidik Pegawai Negeri Sipil</p>
</body>

</html>
<script type="text/javascript">
    //window.print();
</script>