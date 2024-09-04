<?php

$arr_kategori     = array();
$arr_barang       = array();

foreach ($data_stok as $key => $value1) {
  $arr_kategori[$value1->kategori_sub]     = $value1->kategori_sub;
}
foreach ($data_stok as $key => $value2) {
  $arr_barang[$value2->kategori_sub][]     = $value2;
}
if($id_sumber==1){
  $sumber     = 'APBD';
}elseif($id_sumber==2){
  $sumber     = 'BLUD';
}elseif($id_sumber==3){
  $sumber     = 'HIBAH';
}

if($id_kat_barang==1){
  $kat     = 'Bahan Kimia';
}elseif($id_kat_barang==2){
  $kat     = 'BMHP';
}elseif($id_kat_barang==3){
  $kat     = 'Cetakan';
}elseif($id_kat_barang==4){
  $kat     = 'ATK';
}elseif($id_kat_barang==5){
  $kat     = 'Alat Kebersihan';
}

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=LAPORAN_BULANAN_INVENTORY_".strtoupper($kat).".xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>


          <table id="itemsTable" class="table table-bordered table-striped" border="1">
            <thead style="text-align: center;">
            <tr>
              <td colspan="12" align="center">LAPORAN PEMAKAIAN <?= strtoupper($kat); ?></td>
            </tr>
            <tr>
              <td colspan="12" align="center">UPT LABKESDA KOTA TANGERANG</td>
            </tr>
            <tr>  
              <td colspan="12" align="center">ANGGARAN : <?= $sumber.' '.$year; ?></td>
            </tr>
            <tr>  
              <td colspan="12" align="center">PERIODE : <?= strtoupper(date("F Y", strtotime($year.'-'.$month."-01"))); ?></td>
            </tr>
            <tr>
              <td align="center">NO</td>
              <td align="center">NAMA OBAT</td>
              <td align="center">KODE BARANG</td>
              <td align="center">KODE E-KATALOG</td>
              <td align="center">SATUAN</td>
              <td align="center">STOK AWAL</td>
              <td align="center">PENERIMAAN</td>
              <td align="center">PERSEDIAAN</td>
              <td align="center">PEMAKAIAN</td>
              <td align="center">STOK AKHIR</td>
              <td align="center">HARGA SATUAN</td>
              <td align="center">NILAI</td>
            </tr>
            </thead>
            <tbody>
            <?php 
            $no = 0;
            foreach ($arr_kategori as $key => $value_kat) {
              // test($value,1);
            ?>
            <tr>
              <td colspan="12" bgcolor="grey"><?= $value_kat; ?></td>
            </tr>
              <?php
              foreach ($arr_barang[$value_kat] as $key => $value) {
                $no = $no+1;
                $nilai    = $value->stok_akhir*$value->harga_perolehan;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $value->nama; ?></td>
                <td><?= $value->kd_barang; ?></td>
                <td><?= $value->kd_ekatalog; ?></td>
                <td><?= $value->satuan; ?></td>
                <td><?= $value->saldo_awal; ?></td>
                <td><?= $value->penerimaan; ?></td>
                <td><?= $value->saldo_awal; ?></td>
                <td><?= $value->pemakaian; ?></td>
                <td><?= $value->stok_akhir; ?></td>
                <td><?= $value->harga_perolehan; ?></td>
                <td><?= $nilai; ?></td>
              </tr>
            <?php
              } 
            }
            ?>
          </table>