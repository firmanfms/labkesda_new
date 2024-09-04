<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=rekap_parameter_".$kd_lab.".xls");
?>
<table border='1'>
	<thead>
		<tr>
			<td>No.</td>
			<td>Laboratorium</td>
			<td>Kategori Parameter</td>
			<td>Nama Parameter</td>
			<td>Jumlah</td>
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
		    <td><?= $value->lab; ?></td>
		    <td><?= $value->nm_kategori_parameter; ?></td>
		    <td><?= $value->nm_parameter; ?></td>
		    <td><?= $value->jumlah; ?></td>
	  	</tr>
	  	<?php 
	  	}
	  	?>
	</tbody>
</table>