<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=tindakan".$kd_lab.".xls");
?>
<table border='1'>
	<thead>
		<tr>
            <th>No.</th>
                <th>No Pendaftaran</th>
                <th>Nama</th>
                <th>Laboratorium</th>
                <th>Sampel</th>
                <th>Tgl Terima</th>
                <th>Tgl Pengujian</th>
                <th>Tgl Selesai</th>
                <th>Approve</th>
      	</tr>
	</thead>
	<tbody>
	  		<?php
            	$no         = 0; 
                foreach ($pendaftaran as $key => $value) {
                  // test($value,1);
                $no         = $no+1;

                if($value->status_approve==3){
                  $status     = "Approve PJT";
                }else if($value->status_approve==2){
                  $status     = "Approve Koordinator";
                }else if($value->status_approve==4){
                  $status     = "Reject PJT";
                }else{
                  $status     = "Input Hasil";
                }
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?php echo $value->no_pendaftaran; ?></td>
                <td><?php echo $value->nama; ?></td>
                <td><?php echo $value->lab; ?></td>
                <td><?php echo $value->nm_sampel; ?></td>
                <td><?php echo tgl_singkat($value->tgl_diterima); ?></td>
                <td><?php echo tgl_singkat($value->tgl_pengujian); ?></td>
                <td><?php echo tgl_singkat($value->tgl_selesai); ?></td>
                <!-- <td><?php echo $value->nm_parameter; ?></td> -->
                <td><?= $status; ?></td>
              </tr>
              <?php 
              }
              ?>
	</tbody>
</table>