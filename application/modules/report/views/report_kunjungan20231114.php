<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
<style>
@page {
    size: landscape;
    margin: 0px;
}
@media print{
    .break {
      break-inside: avoid;
    }
}

.table-with-border {
  border: 1px solid #000;
  border-collapse: collapse; /* Untuk menghilangkan celah antara sel-sel */
  padding: 5px;
}

/* Tabel tanpa border */
.table-no-border {
  border: none; /* Menghapus border */
}

.highcharts-figure,
.highcharts-data-table table {
    width: 100%;
    margin: 1em auto;
}

.highcharts-figure2,
.highcharts-data-table table {
    width: 100%;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


</style>

<?php 
// test($data_kunjungan_lingkungan,1);
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<table class="table-no-border" style="margin: 20px;">
	<tr>
		<td colspan="2" width="35%" valign="top">
			<table class="table-with-border">
				<tr>
					<td colspan="4" align="center">
						<strong>JUMLAH KUNJUNGAN DAN PEMERIKSAAN<br/>
						UPT LABKESDA KOTA TANGERANG <br/>
						BULAN JULI 2023</strong>
					</td>
				</tr>
				<tr>
					<td class="table-with-border">No. </td>
					<td class="table-with-border" align="center">LABORATORIUM</td>
					<td class="table-with-border" align="center">JUMLAH <br/>KUNJUNGAN</td>
					<td class="table-with-border" align="center">JUMLAH <br/>PEMERIKSAAN</td>
				</tr>
				<?php 
				$no 	= 0;
				foreach ($data_kunjungan as $key => $value) {
					$kunjungan[]     = array(
	                    "name" 		=> $value->lab,
	                    "y"    		=> (int)$value->jml_header,
	                    "drilldown" => $value->lab
	                );

	                $pemeriksaan[]     = array(
	                    "name" 		=> $value->lab,
	                    "y"    		=> (int)$value->jml_detail,
	                    "drilldown" => $value->lab
	                );

				$no 	= $no+1;
				?>
				<tr>
					<td class="table-with-border" align="right"><?= $no; ?>.</td>
					<td class="table-with-border" align="center"><?= $value->lab; ?></td>
					<td class="table-with-border" align="center"><?= $value->jml_header; ?></td>
					<td class="table-with-border" align="center"><?= $value->jml_detail; ?></td>
				</tr>
				<?php 
				}
				?>
				

			</table>
		</td>
		<td colspan="2" width="65%" valign="top">
			<figure class="highcharts-figure">
			    <div id="container1"></div>
			</figure>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top">

		</td>
		<td colspan="2" valign="top">
			<figure class="highcharts-figure">
			    <div id="container2"></div>
			</figure>
		</td>
	</tr>
	<?php 
	$array1         = array();
	$array2         = array();
	foreach ($data_kunjungan_lingkungan as $key => $val1) {
	    $array1[$val1->nm_kategori_parameter] = $val1;
	    $array2[$val1->nm_kategori_parameter][] = $val1;
	}
	$jumlah_array1 		= count($array1);
	// test($jumlah_array1,1);
	?>
	<tr class="break">
		<td colspan="4" width="100%" valign="top">
			<div class="row">
				<div class="col-md-12" style="margin-top: 20px;text-align-last: center;">
					<strong style="font-size:23px">JUMLAH KUNJUNGAN DAN PEMERIKSAAN LABORATORIUM LINGKUNGAN<br/>
					UPT LABKESDA KOTA TANGERANG<br/>
					BULAN JULI 2023<br/></strong>
				</div>
			</div>
			<div class="row">
				<?php 
				// $lipat = 4;
				// for ($i= 1; $i <= $nilai; $i++) { 
				// 	if ($bagi = $i % $lipat == 0 ) {					
				// 		echo '</div> </br>';
				//         if($i!=$nilai){
				//         	echo '<div class="row">';
				//         }
				// 	}else{
				//       	if($nilai==$i){
				//           	echo '</div> </br>';
				//       	}
				//     }
				// }

				$total_lingkungan =0;
				foreach ($array1 as $key => $val1) {
				$total = 0;
				?>
			    <div class="col-md-3" style="margin-top: 20px;">
			    	<table class="table-with-border " width="100%">
			    		<tr>
							<td class="table-with-border" colspan="3" style="background: #cfcfcf"><?= $val1->nm_kategori_parameter; ?></td>
						</tr>
						<tr>
							<td class="table-with-border">No.</td>
							<td class="table-with-border">Parameter</td>
							<td class="table-with-border">Jumlah</td>
						</tr>
						<?php 
						$no = 0;
						foreach ($array2[$val1->nm_kategori_parameter] as $key => $val2) {

							$no=$no+1;

							$lingkungan[]     = array(
			                    "name" 		=> $val2->nm_parameter.' '.$val2->kd_parameter,
			                    "y"    		=> (int)$val2->jml_detail,
			                    "drilldown" => $val2->nm_parameter
			                );
						?>
						<tr>
							<td class="table-with-border" align="right"><?= $no ?>.</td>
							<td class="table-with-border"><?= $val2->nm_parameter; ?></td>
							<td class="table-with-border" align="right"><?= $val2->jml_detail; ?></td>
						</tr>
						<?php 
						$total 				= $total+$val2->jml_detail;
						$total_lingkungan 	= $total_lingkungan+$val2->jml_detail;
						}
						?>
						<tr>
							<td class="table-with-border" colspan="2" style="background: #cfcfcf;"><?= "Jumlah"; ?></td>
							<td class="table-with-border" colspan="1" align="right" style="background: #cfcfcf;"><?= $total; ?></td>
						</tr>
					</table>
			    </div>
			   	<?php 
			   	}
			   	?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="4" width="100%" valign="top">
			<figure class="highcharts-figure2">
		    	<div id="container3"></div>	
		    </figure>
		</td>
	</tr>
</table>
<?php 
$array1a         = array();
$array2a         = array();
foreach ($data_kunjungan_klinik as $key => $val1a) {
    $array1a[$val1a->nm_kategori_parameter] = $val1a;
    $array2a[$val1a->nm_kategori_parameter][] = $val1a;
}
?>
<div class="row break">
	<div class="col-md-12" style="margin-top: 20px;text-align-last: center;">
		<strong style="font-size:23px">JUMLAH KUNJUNGAN DAN PEMERIKSAAN LABORATORIUM KLINIK<br/>
		UPT LABKESDA KOTA TANGERANG<br/>
		BULAN JULI 2023<br/></strong>
	</div>
</div>
<div class="row">
	<?php 
	$total_lingkungan =0;
	foreach ($array1a as $key => $val1a) {
	$total = 0;
	?>
    <div class="col-md-3" style="margin-top: 20px;">
    	<table class="table-with-border" width="100%">
    		<tr>
				<td class="table-with-border" colspan="3" style="background: #cfcfcf"><?= $val1a->nm_kategori_parameter; ?></td>
			</tr>
			<tr>
				<td class="table-with-border">No.</td>
				<td class="table-with-border">Parameter</td>
				<td class="table-with-border">Jumlah</td>
			</tr>
			<?php 
			$no = 0;
			foreach ($array2a[$val1a->nm_kategori_parameter] as $key => $val2a) {

				$no=$no+1;

				$klinik_lab[]     = array(
                    "name" 		=> $val2a->nm_parameter.' '.$val2a->kd_parameter,
                    "y"    		=> (int)$val2a->jml_detail,
                    "drilldown" => $val2a->nm_parameter
                );
			?>
			<tr>
				<td class="table-with-border" align="right"><?= $no ?>.</td>
				<td class="table-with-border"><?= $val2a->nm_parameter; ?></td>
				<td class="table-with-border" align="right"><?= $val2a->jml_detail; ?></td>
			</tr>
			<?php 
			$total 				= $total+$val2a->jml_detail;
			$total_lingkungan 	= $total_lingkungan+$val2a->jml_detail;
			}
			?>
			<tr>
				<td class="table-with-border" colspan="2" style="background: #cfcfcf;"><?= "Jumlah"; ?></td>
				<td class="table-with-border" colspan="1" align="right" style="background: #cfcfcf;"><?= $total; ?></td>
			</tr>
		</table>
    </div>
   	<?php 
   	}
   	?>
</div>
<div class="row break">
	<div class="col-md-12" style="margin-top: 20px;text-align-last: center;">
		<figure class="highcharts-figure2">
	    	<div id="container4"></div>	
	    </figure>
	</div>
</div>









<?php 
$array1ab         = array();
$array2ab         = array();
foreach ($data_kunjungan_klinik as $key => $val1ab) {
    $array1ab[$val1ab->nm_kategori_parameter] = $val1ab;
    $array2ab[$val1ab->nm_kategori_parameter][] = $val1ab;
}
?>
<div class="row break">
	<div class="col-md-12" style="margin-top: 20px;text-align-last: center;">
		<strong style="font-size:23px">JUMLAH KUNJUNGAN DAN PEMERIKSAAN LABORATORIUM KLINIK<br/>
		UPT LABKESDA KOTA TANGERANG<br/>
		BULAN JULI 2023<br/></strong>
	</div>
</div>
<div class="row">
	<?php 
	$total_lingkungan =0;
	foreach ($array1ab as $key => $val1ab) {
	$total = 0;
	?>
    <div class="col-md-3" style="margin-top: 20px;">
    	<table class="table-with-border" width="100%">
    		<tr>
				<td class="table-with-border" colspan="3" style="background: #cfcfcf"><?= $val1ab->nm_kategori_parameter; ?></td>
			</tr>
			<tr>
				<td class="table-with-border">No.</td>
				<td class="table-with-border">Parameter</td>
				<td class="table-with-border">Jumlah</td>
			</tr>
			<?php 
			$no = 0;
			foreach ($array2ab[$val1ab->nm_kategori_parameter] as $key => $val2ab) {

				$no=$no+1;

				$maknum_lab[]     = array(
                    "name" 		=> $val2ab->nm_parameter.' '.$val2ab->kd_parameter,
                    "y"    		=> (int)$val2ab->jml_detail,
                    "drilldown" => $val2ab->nm_parameter
                );
			?>
			<tr>
				<td class="table-with-border" align="right"><?= $no ?>.</td>
				<td class="table-with-border"><?= $val2ab->nm_parameter; ?></td>
				<td class="table-with-border" align="right"><?= $val2ab->jml_detail; ?></td>
			</tr>
			<?php 
			$total 				= $total+$val2ab->jml_detail;
			$total_lingkungan 	= $total_lingkungan+$val2ab->jml_detail;
			}
			?>
			<tr>
				<td class="table-with-border" colspan="2" style="background: #cfcfcf;"><?= "Jumlah"; ?></td>
				<td class="table-with-border" colspan="1" align="right" style="background: #cfcfcf;"><?= $total; ?></td>
			</tr>
		</table>
    </div>
   	<?php 
   	}
   	?>
</div>
<div class="row break">
	<div class="col-md-12" style="margin-top: 20px;text-align-last: center;">
		<figure class="highcharts-figure2">
	    	<div id="container5"></div>	
	    </figure>
	</div>
</div>





<script>
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container1', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'JUMLAH KUNJUNGAN UPT LABKESDA KOTA TANGGERANG JULI 2023'
    },
    accessibility: { announceNewData: { enabled: true } },
    xAxis: { type: 'category' },
    yAxis: { title: { text: ' ' } },
    legend: { enabled: false },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
    },
    series: [{
            name: 'Laboratorium',
            colorByPoint: false,
            data: <?php echo json_encode($kunjungan,1); ?>
    }]
});

Highcharts.chart('container2', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'JUMLAH PEMERIKSAAN UPT LABKESDA KOTA TANGGERANG JULI 2023'
    },
    accessibility: { announceNewData: { enabled: true } },
    xAxis: { type: 'category' },
    yAxis: { title: { text: ' ' } },
    legend: { enabled: false },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
    },
    series: [{
            name: 'Laboratorium',
            colorByPoint: true,
            data: <?php echo json_encode($pemeriksaan,1); ?>
    }]
});

Highcharts.chart('container3', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'REKAP PEMERIKSAAN LAB. LINGKUNGAN'
    },
    accessibility: { announceNewData: { enabled: true } },
    xAxis: { type: 'category' },
    yAxis: { title: { text: ' ' } },
    legend: { enabled: false },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
    },
    series: [{
            name: 'Laboratorium',
            colorByPoint: false,
            data: <?php echo json_encode($lingkungan,1); ?>
    }]
});

Highcharts.chart('container4', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'REKAP PEMERIKSAAN LAB. KLINIK'
    },
    accessibility: { announceNewData: { enabled: true } },
    xAxis: { type: 'category' },
    yAxis: { title: { text: ' ' } },
    legend: { enabled: false },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
    },
    series: [{
            name: 'Laboratorium',
            colorByPoint: false,
            data: <?php echo json_encode($klinik_lab,1); ?>
    }]
});

Highcharts.chart('container5', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'REKAP PEMERIKSAAN LAB. MAKMIN'
    },
    accessibility: { announceNewData: { enabled: true } },
    xAxis: { type: 'category' },
    yAxis: { title: { text: ' ' } },
    legend: { enabled: false },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
    },
    series: [{
            name: 'Laboratorium',
            colorByPoint: false,
            data: <?php echo json_encode($maknum_lab,1); ?>
    }]
});



</script>