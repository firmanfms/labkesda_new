<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=stok.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>


          <table id="itemsTable" class="table table-bordered table-striped" border="1">
            <tr>
              <th colspan="9">Laporan Stok per Tanggal <?= tgl_singkat($tgl_smp) ?></th>
            </tr>
            <thead>
            <tr>
              <th width="9%">Kode</th>
              <th>Nama</th>
              <th width="9%">Satuan</th>
              <th>Lokasi</th>
              <th>Sub Lokasi</th>
              <th width="7%">Qty</th>
              <th width="12%">Harga Perolehan</th>
              <th>Lot Number</th>
              <th width="9%">Tanggal Kadaluarsa</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($data_mutasi,1);
            foreach ($data_mutasi as $key => $value) {
              $bulan          = substr($value->tgl,5,2);
              $hari           = substr($value->tgl,8,2);
              $tahun          = substr($value->tgl,0,4);
              $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
              if($tanggal=='//'){ $tanggal='';}
            ?>
            <tr>
              <td><?= $value->barcode; ?></td>
              <td><?= $value->nama; ?></td>
              <td><?= $value->satuan; ?></td>
              <td><?= $value->lokasi; ?></td>
              <td><?= $value->tempat; ?></td>
              <td><?= $value->qty; ?></td>
              <td><?= $value->harga_perolehan; ?></td>
              <td><?= $value->lot_no; ?></td>
              <td><?= $tanggal; ?></td>
            </tr>
            <?php 
            }
            ?>
          </table>