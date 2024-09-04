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
// test($data_kunjungan,1);
if($kd_lab=='LL'){
	$labor 		= "LABORATORIUM LINGKUNGAN";
}elseif($kd_lab=='LK'){
	$labor 		= "LABORATORIUM KLINIK";
}elseif($kd_lab=='LM'){
	$labor 		= "LABORATORIUM MAKANAN DAN MINNUMAN";
}
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<table class="table-no-border" style="margin: 20px;">
	<?php 
	$array1         = array();
	$array2         = array();
	foreach ($data_kunjungan as $key => $val1) {
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
					<strong style="font-size:23px">JUMLAH KUNJUNGAN DAN PEMERIKSAAN <?= $labor; ?><br/>
					UPT LABKESDA KOTA TANGERANG<br/>
					Tanggal <?= tgl_singkat($tgl_dari).' s/d '.tgl_singkat($tgl_smp); ?><br/></strong>
				</div>
			</div>
			<div class="row">
				<?php 

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


<script>

Highcharts.chart('container3', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'REKAP PEMERIKSAAN <?= $labor; ?>'
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


</script>