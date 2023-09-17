<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cetak Gaji</title>
    <style>
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h3 class="text-center">PT. MAJU JAYA</h3>
    <p class="text-center">Jl. Mawar No.1 Gresik Jawa Timur</p>
    <hr>
    <h5 class="text-center">Slip Gaji</h5>
    <hr>
    <p>Periode : <?= date_indo($periode_awal) ?> - <?= date_indo($periode_akhir) ?></p>
    <p>Nama Karyawan : <?= $nama ?></p>
    <p>Jabatan : <?= $jabatan ?></p>
    <p>Status : <?= $status ?></p>
    <hr>
    <p><b>PENERIMAAN</b></p>
    <table>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td class="text-right"><?= number_format($gaji_pokok, 2, ",", "."); ?></td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td class="text-right"><?= number_format($tunjangan, 2, ",", "."); ?></td>
            </tr>
            <tr>
                <td>Insentif</td>
                <td class="text-right"><?= number_format($insentif, 2, ",", "."); ?></td>
            </tr>
            <tr>
                <td>Lembur</td>
                <td class="text-right"><?= number_format($total_lembur, 2, ",", "."); ?></td>
            </tr>
        </tbody>
    </table>
    <p><b>PENGURANGAN</b></p>
    <table>
        <tbody>
            <tr>
                <td>NWNP</td>
                <td class="text-right"><?= number_format($pot_nwnp, 2, ",", "."); ?></td>
            </tr>
            <tr>
                <td>BPJS</td>
                <td class="text-right"><?= number_format($pot_bpjs, 2, ",", "."); ?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table>
        <tbody>
            <tr>
                <td>Total Gaji</td>
                <td class="text-right"><?= number_format($total_gaji, 2, ",", "."); ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>