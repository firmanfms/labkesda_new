<?php 
// test($header,0);
?>
<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
}
?>
<!-- <div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
        	<div class="box-header with-border"></div> -->
        	<form class="form-horizontal">
          	<div class="box-body">
	            <div class="form-group">
	              	<label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
	              	<div class="col-sm-3" style="top: 7px;">: Lab Klinik </div>
	              	<label for="inputEmail3" class="col-sm-3 control-label">Nomor Pendaftaran</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->no_pendaftaran; ?></div>
	            </div>
	            <div class="form-group">
	              	<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->nama; ?></div>
	              	<label for="inputEmail3" class="col-sm-3 control-label">Alamat</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->alamat; ?></div>
	            </div>
	            <div class="form-group">
	              	<label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->telp; ?></div>
	              	<label for="inputEmail3" class="col-sm-3 control-label">Umur</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->umur; ?></div>
	            </div>
	            <div class="form-group">
	              	<label for="inputEmail3" class="col-sm-2 control-label">Dokter</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->dokter; ?></div>
	              	<label for="inputEmail3" class="col-sm-3 control-label">Diagnosa</label>
	              	<div class="col-sm-3" style="top: 7px;">: <?php echo $header->diagnosa_klinik; ?></div>
	            </div>
	            <div class="form-group">              
	              	<label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
	              	<div class="col-sm-5" style="top: 7px;">: <?php echo $header->diagnosa_klinik; ?></div>
	            </div>
            	<div class="col-md-12">
              		<div class="table-responsive">
                	<table id="detail2" class="table table-bordered table-striped">
	                  	<thead>
		                    <tr>
		                      <th>Parameter yang diperiksa</th>
		                      <th width="13%">Satuan</th>
		                      <th>Kadar maksimum <br/>yang diperbolehkan</th>
		                      <th width="25%">Metode Uji</th>
		                    </tr>
	                  	</thead>
	                    <?php 
	                    $no = 0;
	                    foreach ($detail_kdpar as $key => $value) {
	                    ?>
		                    <tr>
								<td><u>--&nbsp;&nbsp;<?php echo $value->nm_kategori_parameter; ?>&nbsp;&nbsp;--</u></td>
								<td></td>
								<td></td>
								<td></td>
		                    </tr>
	                    <?php                     
	                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value2) {
	                      	$no = $no+1;
	                    ?>
	                    <tr>
							<td><?php echo $value2->nm_parameter; ?></td>
							<td><?php echo $value2->satuan; ?></td>
							<td><?php echo $value2->kadar; ?></td>
							<td><?php echo $value2->metode_analisa; ?></td>
	                    </tr>
	                    <?php
	                    }
	                    }
	                    ?>         
	                </table>
              		</div>
            	</div>   
        	</div>
        	</form>
<!--       	</div>
    </div>
</div> -->