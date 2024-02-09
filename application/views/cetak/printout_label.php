<html lang="en" class="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            margin-bottom: 5px;

        }
    </style>
    <title>Cetak Label</title>
</head>

<body>

    <?php foreach ($data as $datar) :
        $detail_bus = getDetailBus($datar); ?>
    <table>
    <tbody>
        <tr>
            <td colspan="3">
                <center>TTA KUNINGAN</center>
            </td>
        </tr>
        <tr>
            <td rowspan="4">
                <center>
                    <img style="width:100px;" src="<?= base_url(QR_LOAD_PATH) . $detail_bus->id_bus . '.png' ?>" alt="">
                </center>
            </td>
            <td>
                <center><?=@$detail_bus->nama_po?></center>
            </td>
        </tr>
        <tr>
            <td>
                <center><?=@$detail_bus->nomor_plat_kendaraan?></center>
            </td>
        </tr>
        <tr>
            <td>
                <center><?=@$detail_bus->trayek?></center>
            </td>
        </tr>
    </tbody>
</table>
    <?php endforeach;
    ?>
</body>

</html>
<script>
    window.print();
</script>