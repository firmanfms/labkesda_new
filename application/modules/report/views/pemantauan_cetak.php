<?php
if($cetak=='excell'){
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=report_Pemantauan_Mutu_Internal.xls");
}
?>
<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse; 
  }
</style>
<table id="itemsTable" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>Parameter</th>
    <th colspan="8"><?= $nm_parameter; ?></th>
  </tr>
  <tr>
	<th>No Pendaftaran</th>
    <th>Kode Sampel </th>
    <th width="9%">Tanggal</th>
    <th width="15%">Metode Analisa</th>
    <th width="9%">RPD</th>
    <th width="9%">P1</th>
    <th width="9%">P2</th>
    <th width="9%">Blanko</th>
    <th width="9%">Rec</th>
    <!-- <th width="12%">Harga Perolehan</th> -->
    <th>CRM</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  // test($data_mutasi,1);
  foreach ($data_mutasi as $key => $value) {
    // test($value,1);
    // $bulan          = substr($value->tgl,5,2);
    // $hari           = substr($value->tgl,8,2);
    // $tahun          = substr($value->tgl,0,4);
    // $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
    // if($tanggal=='//'){ $tanggal='';}
  ?>
  <tr>
    <td><?= $value->no_pendaftaran; ?></td>
	<td><?= $value->nm_sampel; ?></td>
    <td><?= tgl_singkat($value->tgl_input); ?></td>
    <td><?= $value->metode_analisa; ?></td>
    <td><?= $value->rpd; ?></td>
    <td><?= $value->p1; ?></td>
    <td><?= $value->p2; ?></td>
    <td><?= $value->blanko; ?></td>
    <td><?= $value->rec; ?></td>
    <!-- <td align="right"><?= money($value->harga_perolehan); ?></td> -->
    <td><?= $value->crm; ?></td>
  </tr>
  <?php 
  }
  ?>
</table>