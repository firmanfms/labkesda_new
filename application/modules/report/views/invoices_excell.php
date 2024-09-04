<?php
// pre($pendaftaran);exit();
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=rekap_invoices_".$kd_lab.".xls");
?>
<table border='1'>
Report Rekap Status Invoice dari tanggal <?php echo $tgl_dari;?> - <?php echo $tgl_smp;?>
	<thead>
		<tr>
    <td>No.</td>
                <td>Tanggal </td>
                <td>No. Pendaftaran</td>
                <td>Nama Customer</td>
                <td>Laboratorium</td>
                <!--<td>Parameter</td>-->
                <td>Total Invoices</td>
                <td>Status</td>
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
                <td><?= $value->nama; ?></td>
                <td><?= $value->kd_lab; ?></td>
                <!--<td><?= $value->nm_parameter; ?></td> -->
                <td text-align="right"><?=  ($value->total_harga); ?></td> 
                <td><?=  ($value->status_bayar=='yes')? '<span class="label label-success">Sudah Bayar</span>' : '<span class="label label-danger">Belum Bayar</span>'; ?></td> 
              </tr>
              <?php 
              }
              ?>
	</tbody>
</table>