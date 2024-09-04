<?php
// pre($pendaftaran);exit();
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=rekap_analis_".$kd_lab.".xls");
?>
<table border='1'>
Report Rekap per Analis dari tanggal <?php echo $tgl_dari;?> - <?php echo $tgl_smp;?>
	<thead>
		<tr>
				<td>No.</td>
                <td>Tanggal Pengujian</td>
                <td>No. Pendaftaran</td>
                <td>Laboratorium</td>
                <td>Nama Parameter</td>
                <td>Nama Analis</td>
		</tr>
	</thead>
	<tbody>
		<?php
              $no         = 0; 
                foreach ($pendaftaran as $key => $value) {
                $no         = $no+1;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= kiri($value->tgl_pengujian,10); ?></td>
                <td><?= $value->no_pendaftaran; ?></td>
                <td><?= $value->kd_lab; ?></td>
                <td><?= $value->nm_parameter; ?></td>
                <td><?= $value->nama_analis; ?></td> 
              </tr>
              <?php 
              }
              ?>
	</tbody>
</table>