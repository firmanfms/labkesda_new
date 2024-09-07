<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_lab.xls");
?>

<table border='1'>
    <thead>
        <tr>
            <th width="3%">No.</th>
            <th width="9%">Tgl Terima</th>
            <th width="9%">Nama</th>
            <th>Alamat</th>
            <th>Kategori Paramter</th>
            <?php
            foreach ($title_param as $key => $value) {
                $namaParam = $value->nm_parameter;
                echo "<th>$namaParam</th>";
            }
            ?>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($pendaftaran as $key => $value) {
            $tglTerima = tgl_singkat($value->tgl_diterima);
            $labelName = $value->nama . " <br/> " . $value->no_pendaftaran;
            $alamat = $value->alamat;
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>$tglTerima</td>";
            echo "<td>$labelName</td>";
            echo "<td>$alamat</td>";
            echo "<td>";
            foreach ($value->kategori_params as $keyKat => $valueKat) {
                $kodeKat = $valueKat->kd_kategori_parameter;
                $namaKat = $valueKat->nm_kategori_parameter;
                echo "$namaKat<br/>";
            }
            echo "</td>";
            foreach ($title_param as $keyTitle => $valueTitle) {
                $namaParam = $valueTitle->nm_parameter;
                $kodeParam = $valueTitle->kd_parameter;
                if (isset($value->detail[$kodeParam])) {
                    $currentDetail = $value->detail[$kodeParam];
                    $valueDetail = $currentDetail->nilai;
                    echo "<td>$valueDetail</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
            $no++;
        }
        ?>
        </tr>
</table>