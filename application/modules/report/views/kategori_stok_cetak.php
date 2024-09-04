<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=stok_perkategori_".$tgl_dari.".xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<?php 
// test($data_stok,1);

$arr_kategori     = array();
$arr_barang       = array();

foreach ($data_stok as $key => $value1) {
  $arr_kategori[$value1->kategori_sub]     = $value1->kategori_sub;
}
foreach ($data_stok as $key => $value2) {
  $arr_barang[$value2->kategori_sub][]     = $value2;
}
// test($arr_barang['REAGENT TAMBAHAN'],1);

?>
          <table width="100%" class="table table-bordered table-striped" border="1">
            <thead>
              <tr>
                <th colspan="14">DAFTAR HASIL PEMERIKSAAN / OPNAME FISIK PERSEDIAAN</th>
              </tr>
              <tr>
                <th colspan="14">Tanggal <?= tgl_singkat($tgl_dari) ?></th>
              </tr>
              <tr>
                <th rowspan="2">NO.</th>
                <th rowspan="2" width="9%">KODE</th>
                <th rowspan="2">NAMA BARANG</th>
                <th rowspan="2" width="15%">NAMA PABRIK / MERK</th>
                <th rowspan="2" width="15%">SATUAN</th>
                <th colspan="3">MENURUT LAPORAN</th>
                <th colspan="3">MENURUT PEMERIKSAAN / OPNAME FISIK</th>
                <th colspan="3">SELISIH</th>
              </tr>
              <tr>
                <th width="7%">VOLUME</th>
                <th width="7%">HARGA SATUAN</th>
                <th width="7%">NILAI</th>
                <th width="7%">VOLUME</th>
                <th width="7%">HARGA SATUAN</th>
                <th width="7%">NILAI</th>
                <th width="7%">VOLUME</th>
                <th width="7%">HARGA SATUAN</th>
                <th width="7%">NILAI</th>
              </tr>
            </thead>
            <?php
            $no     = 0;
            foreach ($arr_kategori as $key => $value_kat) {
            ?>
            <thead>
              <tr>
                <td colspan="14"><?= $value_kat; ?></td>
              </tr>
            </thead>
            <tbody style="font-weight: 500 !important;">
              <?php
              foreach ($arr_barang[$value_kat] as $key => $value) {
                $total    = 0;
                if($value->qty!='0' || $value->qty !='' || $value->harga_perolehan !='0' || $value->harga_perolehan !=''){
                  $total  = $value->qty * $value->harga_perolehan;
                }
              $no++;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $value->barcode; ?></td>
                <td><?= $value->nama; ?></td>
                <td><?= $value->nm_vendor; ?></td>
                <td><?= $value->satuan; ?></td>
                <td><?= ($value->qty>0)? money($value->qty) : '0'; ?></td>
                <td><?= money($value->harga_perolehan); ?></td>
                <td><?= money($total); ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <?php
              }
            }
            ?>
            </tbody>
          </table>