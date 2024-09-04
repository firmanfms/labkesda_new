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
						Tanggal <?= tgl_singkat($tgl_dari).' s/d '.tgl_singkat($tgl_smp); ?></strong>
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
</table>

<script>
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container1', {
    chart: { type: 'column' },
    title: {
        align: 'center',
        text: 'JUMLAH KUNJUNGAN UPT LABKESDA KOTA TANGGERANG Tanggal <?= tgl_singkat($tgl_dari).' s/d '.tgl_singkat($tgl_smp); ?>'
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
        text: 'JUMLAH PEMERIKSAAN UPT LABKESDA KOTA TANGGERANG Tanggal <?= tgl_singkat($tgl_dari).' s/d '.tgl_singkat($tgl_smp); ?>'
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


</script>