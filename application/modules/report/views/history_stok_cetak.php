<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=history_stok_".$tgl_dari.".xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
            <table width="100%" class="table table-bordered table-striped" border="1">
              <tr>
                <td width="10%" colspan="7" align="center">Laporan Histori Stok</td>
              </tr>
            </table>
          <?php 
          foreach ($data_mutasi as $key => $value1) {
          ?>
            <table width="100%" class="table table-bordered table-striped" border="1">
              <tr>
                <td width="10%">Kode Barang</td>
                <td><?= $value1->barcode; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Nama Barang</td>
                <td><?= $value1->nama; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Lot Number</td>
                <td><?= $value1->lot_no; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Saldo Awal</td>
                <td><?= $value1->saldo_awal; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
            <table class="table table-bordered table-striped" border="1">
              <thead>
                <tr>
                  <th width="9%">Kode</th>
                  <th>Nama</th>
                  <th width="9%">Tanggal Transaksi</th>
                  <th width="9%">Tanggal Kadaluarsa</th>
                  <!-- <th width="7%">Stok Awal</th> -->
                  <th width="7%">Qty In</th>
                  <th width="7%">Qty Out</th>
                  <th width="7%">Stok Akhir</th>
                </tr>
              </thead>
              <?php               
              $sisa       = $value1->saldo_awal;
              $query    = "SELECT * FROM `t_stok` a,m_barang b 
              WHERE a.id_barang=b.id_barang AND a.id_barang = '".$value1->id_barang."' AND a.id_lokasi = '".$id_lokasi."' AND a.lot_no = '".$value1->lot_no."' AND
              a.tgl_transaksi <= '".$tgl_smp."' AND a.tgl_transaksi >= '".$tgl_dari."' ORDER BY a.tgl_transaksi ASC,a.id_barang";
              // test($query,0);
              $history  = $this->db->query($query)->result();
              foreach ($history as $key => $value) {
                $bulan          = substr($value->tgl_kadaluwarsa,5,2);
                $hari           = substr($value->tgl_kadaluwarsa,8,2);
                $tahun          = substr($value->tgl_kadaluwarsa,0,4);
                $tanggal        = $hari.'/'.$bulan.'/'.$tahun;
                if($tanggal=='01/01/1700'){ $tanggal='';}
                $sisa     = $sisa + $value->qty;
              ?>
              <tr>
                <td><?= $value->barcode; ?></td>
                <td><?= $value->nama; ?></td>
                <td><?= tgl_singkat($value->tgl_transaksi); ?></td>
                <td><?= $tanggal; ?></td>
                <!-- <td><?= $value->old_stock; ?></td> -->
                <td><?= ($value->qty>0)? $value->qty : '0'; ?></td>
                <td><?= ($value->qty<0)? $value->qty : '0'; ?></td>
                <td><?= $sisa; ?></td>
              </tr>
              <?php 
              }
              ?>
              <tr>
                <td></td>
                <td colspan="5">Saldo Akhir</td>
                <!-- <td><?= $value->old_stock; ?></td> -->
                <td><?= $sisa; ?></td>
              </tr>
            </table>
            <hr>
          <?php 
          }
          ?>