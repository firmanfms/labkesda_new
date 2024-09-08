<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_lab.xls");
?>

<table border='1'>
    <thead>
        <tr>
            <th width="3%">No.</th>
			<th width="5%">No. Pendaftaran</th>
			<th width="5%">Jenis Sampel</th>
            <th width="9%">Tgl Terima</th>
            <th width="9%">Nama</th>
            <th>Alamat</th>
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
			$noPendaftaran = $value->no_pendaftaran;
			$jnsSampel = $value->nm_sampel;
            $tglTerima = tgl_singkat($value->tgl_diterima);
            $labelName = $value->nama;
            $alamat = $value->alamat;
            echo "<tr>";
            echo "<td>$no</td>";
			echo "<td>$noPendaftaran</td>";
			echo "<td>$jnsSampel</td>";
            echo "<td>$tglTerima</td>";
            echo "<td>$labelName</td>";
            echo "<td>$alamat</td>";
            foreach ($title_param as $keyTitle => $valueTitle) {
                $namaParam = $valueTitle->nm_parameter;
                $kodeParam = $valueTitle->kd_parameter;
                if (isset($value->detail[$kodeParam])) {
                    $currentDetail = $value->detail[$kodeParam];
                    $valueDetail = $currentDetail->nilai;
                    echo "<th>$valueDetail</th>";
                } else {
                    echo "<th></th>";
                }
            }
            echo "</tr>";
            $no++;
        }
        ?>
        </tr>
</table>