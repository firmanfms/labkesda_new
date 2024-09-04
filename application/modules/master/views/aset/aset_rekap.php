<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap Aset.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$arr_kategori     = array();
$arr_barang       = array();

foreach ($data_aset as $key => $value1) {
  $arr_kategori[$value1->kategori]     = $value1->kategori;
}
foreach ($data_aset as $key => $value2) {
  $arr_barang[$value2->kategori][]     = $value2;
}
?>

          <table id="itemsTable" class="table table-bordered table-striped" border="1">
            <thead>
            <tr>
              <td colspan="2">UPT </td>
              <td colspan="5">: Labkesda</td>
            </tr>
            <tr>
              <td colspan="2">KOTA </td>
              <td colspan="5">: Kota Tangerang</td>
            </tr>
            <tr>
              <td colspan="2">PROVINSI </td>
              <td colspan="5">: Banten</td>
            </tr>
            <tr>
              <td colspan="7" align="Center">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="7" align="Center">LAPORAN PENGADAAN BARANG</td>
            </tr><tr>
              <td colspan="7" align="Center">&nbsp;</td>
            </tr>
            <tr>
              <th style="text-align: center;" rowspan="2">No</th>
              <th width="15%" style="text-align: center;" rowspan="2">Nama Barang</th>
              <th style="text-align: center;" colspan="2">Aset Tetap</th>
              <th style="text-align: center;" colspan="2">Inventaris</th>
              <th style="text-align: center;" rowspan="2">Harga</th>
            </tr>
            <tr>              
              <th style="text-align: center;">Unit</th>
              <th style="text-align: center;">Nilai</th>
              <th style="text-align: center;">Unit</th>
              <th style="text-align: center;">Nilai</th>
              <!-- <th width="8%" style="text-align: center;">Kode Aset</th>
              <th style="text-align: center;">Serial Number</th>
              <th width="8%" style="text-align: center;">Tanggal Perolehan</th>
              <th style="text-align: center;">Harga</th>
              <th style="text-align: center;">Sumber</th>
              <th style="text-align: center;">Lokasi</th>
              <th style="text-align: center;">Kategory</th> -->
              <!-- <th width="10%" style="text-align: center;">Action</th> -->
            </tr>
            </thead>
            <tbody>
            <?php 
            // test($arr_kategori,1);
            // test($data_aset,1);
            $no_kat   = 0;
            $no       = 0;
            $tjumlah  = 0;
            $tstok    = 0;
            $total_qty_aset     = 0;
            $total_nilai_aset   = 0;
            $total_qty_inves    = 0;
            $total_nilai_inves  = 0;
            $total_barang       = 0;
            foreach ($arr_kategori as $key => $value) {
              $no_kat     = $no_kat+1;

              $query_tetap          = $this->db->query("SELECT SUM(a.jumlah)unit,e.kategori,SUM((a.harga_perolehan*a.jumlah))nilai_tetap,a.tipe_aset
                                              FROM m_assets a
                                              LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                                              LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                                              LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                                              LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                                              WHERE a.aktif='Y'  AND a.tipe_aset='Aset Tetap' AND e.kategori='".$value."'
                                              GROUP BY a.id_kat_barang");
              $t_tetap              = $query_tetap->num_rows();
              $d_tetap              = $query_tetap->row();

              $query_inventaris     = $this->db->query("SELECT SUM(a.jumlah)unit,e.kategori,SUM((a.harga_perolehan*a.jumlah))nilai_tetap,a.tipe_aset
                                              FROM m_assets a
                                              LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                                              LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                                              LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                                              LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                                              WHERE a.aktif='Y'  AND a.tipe_aset='Inventaris' AND e.kategori='".$value."'
                                              GROUP BY a.id_kat_barang");
              $t_inventaris         = $query_inventaris->num_rows();
              $d_inventaris         = $query_inventaris->row();

              if($t_inventaris>=1){
                $qty_inventaris       = $d_inventaris->unit;
                $harga_inventaris     = $d_inventaris->nilai_tetap;
              }else{
                $qty_inventaris       = 0;
                $harga_inventaris     = 0;
              }

              if($t_tetap>=1){
                $qty_tetap            = $d_tetap->unit;
                $harga_tetap          = $d_tetap->nilai_tetap;
              }else{
                $qty_tetap            = 0;
                $harga_tetap          = 0;
              }

              $total_qty_aset         = $qty_tetap+$total_qty_aset;
              $total_nilai_aset       = $harga_tetap+$total_nilai_aset;

              $total_qty_inves        = $qty_inventaris+$total_qty_inves;
              $total_nilai_inves      = $harga_inventaris   +$total_nilai_inves;

              $total_kategori         = $total_nilai_aset+$total_nilai_inves;
            ?>
            <tr>
              <td align="right"><?php echo $no_kat; ?></td>
              <td><?php echo $value; ?></td>
              <td align="right"><?= $qty_tetap; ?></td>
              <td align="right"><?= $harga_tetap; ?></td>
              <td align="right"><?= $qty_inventaris; ?></td>
              <td align="right"><?= $harga_inventaris; ?></td>
              <td align="right"><?= $total_kategori; ?></td>
            </tr>
            <?php 
              $no_barang=0;
              

              foreach ($arr_barang[$value] as $key => $value2) {
                // test($value2,1);
                $no_barang      = $no_barang+1; 

                $q_barang_aset_tetap       = $this->db->query("SELECT SUM(a.jumlah)unit,e.kategori,SUM((a.harga_perolehan*a.jumlah))nilai_tetap,a.tipe_aset
                                              FROM m_assets a
                                              LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                                              LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                                              LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                                              LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                                              WHERE a.aktif='Y'  AND a.tipe_aset='Aset Tetap' AND a.nama='".$value2->nama."'
                                              GROUP BY a.id_kat_barang")->row();

                $q_barang_inventris        = $this->db->query("SELECT SUM(a.jumlah)unit,e.kategori,SUM((a.harga_perolehan*a.jumlah))nilai_tetap,a.tipe_aset
                                                FROM m_assets a
                                                LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                                                LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                                                LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                                                LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                                                WHERE a.aktif='Y'  AND a.tipe_aset='Inventaris' AND a.nama='".$value2->nama."'
                                                GROUP BY a.id_kat_barang")->row();
                if(isset($q_barang_aset_tetap->nilai_tetap)!=''){
                  $nilai_tetap_aset       = $q_barang_aset_tetap->nilai_tetap;
                  $qty_aset               = $q_barang_aset_tetap->unit;
                }else{
                  $nilai_tetap_aset       = 0;
                  $qty_aset               = 0;
                }

                if(isset($q_barang_inventris->nilai_tetap)!=''){
                  $nilai_tetap_inven      = $q_barang_inventris->nilai_tetap;
                  $qty_inven              = $q_barang_inventris->unit;
                }else{                  
                  $nilai_tetap_inven      = '0';
                  $qty_inven              = '0';
                }

                $total_barang       = $nilai_tetap_aset+$nilai_tetap_inven;
              ?>
              <tr>
                <td align="right"><?php echo $no_barang; ?></td>
                <td><?php echo $value2->nama; ?></td>
                <td align="right"><?= ($qty_aset!=0)? $qty_aset : ''; ?></td>
                <td align="right"><?= ($nilai_tetap_aset!=0)? $nilai_tetap_aset : ''; ?></td>
                <td align="right"><?= ($qty_inven!=0)? $qty_inven : ''; ?></td>
                <td align="right"><?= ($nilai_tetap_inven!=0)? $nilai_tetap_inven : ''; ?></td>
                <td align="right"><?= $total_barang; ?></td>
              </tr>
              <?php
              }
            }

            ?>
            <tr>
              <td align="right"></td>
              <td align="right">Total</td>
              <td align="right"><?= $total_qty_aset; ?></td>
              <td align="right"><?= $total_nilai_aset; ?></td>
              <td align="right"><?= $total_qty_inves; ?></td>
              <td align="right"><?= $total_nilai_inves; ?></td>
              <td align="right"><?= $total_barang; ?></td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center">MENGETAHUI,</td>
              <td colspan="3"></td>
            </tr>
            <tr>
              <td colspan="4" align="center">KUASA PENGGUNA BARANG</td>
              <td colspan="3" align="center">PENGURUS BARANG PEMBANTU</td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="7"&nbsp;>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center">dr. Lulik Sri Adarini, MM</td>
              <td colspan="3" align="center">Maulana Abik, SST</td>
            </tr>
            <tr>
              <td colspan="4" align="center">NIP. 19741224 200604 2 017</td>
              <td colspan="3" align="center">NIP. 19800105 200604 1 027</td>
            </tr>
          </table>