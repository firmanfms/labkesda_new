<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Outstanding".$kd_lab.".xls");
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
            <th>Waktu Jatuh Tempo</th>
            <th>Approve</th>
      	</tr>
	</thead>
	<tbody>
	  		<?php
            	$no         = 0; 
                foreach ($pendaftaran as $key => $value) {
                  // test($value,1);
                $no         = $no+1;
                $selisih    = '';

                if($value->status_approve==3){
                  	$status     = "Approve PJT";
                }else if($value->status_approve==2){
                  	$status     = "Approve Koordinator";
                }else if($value->status_approve==4){
                  	$status     = "Reject PJT";
                }else{
                  	$status     = "Input Hasil";
                }

                $tgl1     = new DateTime(dbnow(false));
                $tgl2     = new DateTime($value->tgl_selesai);
                $jarak    = $tgl2->diff($tgl1);

                $selisih  = '';
                if($value->tgl_selesai){
                  	$selisih  = $jarak->d;
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
	                <td><?php echo $selisih; ?></td>
	                <td><?= $status; ?></td>
              	</tr>
              <?php 
              }
              ?>
	</tbody>
</table>