<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Detail Asset.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>

          <table id="itemsTable" class="table table-bordered table-striped" border="1">
            <thead>
            <tr>
              <td colspan="21" align="Center">KARTU INVENTARIS BARANG (KIB) B</td>
            </tr>
            <tr>
              <td colspan="21" align="Center">PERALATAN DAN MESIN</td>
            </tr>
            <tr>
              <td colspan="21" align="Center">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">UPT </td>
              <td colspan="18">: Labkesda</td>
            </tr>
            <tr>
              <td colspan="3">KOTA </td>
              <td colspan="18">: Kota Tangerang</td>
            </tr>
            <tr>
              <td colspan="3">PROVINSI </td>
              <td colspan="18">: Banten</td>
            </tr>
            <tr>
              <td colspan="3">ALAMAT </td>
              <td colspan="18">: Jl. TMP Taruna Kel. Sukaasih Kec. Tangerang</td>
            </tr>
            <tr>
              <td colspan="21" align="Center">&nbsp;</td>
            </tr>
            <tr>
              <th style="text-align: center;" rowspan="2">No</th>
              <th style="text-align: center;" colspan="2">Kode Barang</th>
              <th width="15%" style="text-align: center;" rowspan="2">Nama Barang</th>
              <th style="text-align: center;" rowspan="2">No Register</th>
              <th style="text-align: center;" rowspan="2">Jumlah</th>
              <th style="text-align: center;" rowspan="2">Merk</th>
              <th style="text-align: center;" rowspan="2">Ukuran</th>
              <th style="text-align: center;" rowspan="2">Bahan</th>
              <th style="text-align: center;" rowspan="2">Tahun</th>
              <th style="text-align: center;" colspan="5">Nomor</th>
              <th style="text-align: center;" rowspan="2">Asal Usul Cara Perolehan</th>
              <th style="text-align: center;" colspan="3">Harga</th>
              <th style="text-align: center;" rowspan="2">Kondisi</th>
              <th style="text-align: center;"  rowspan="2">Ket</th>
            </tr>
            <tr>              
              <th style="text-align: center;">Lokasi</th>
              <th style="text-align: center;">Barang</th>
              <th style="text-align: center;">Pabrik</th>
              <th style="text-align: center;">Rangka</th>
              <th style="text-align: center;">Mesin</th>
              <th style="text-align: center;">Polis</th>
              <th style="text-align: center;">BPKB</th>
              <th style="text-align: center;">Satuan</th>
              <th style="text-align: center;">Homor + Adm</th>
              <th style="text-align: center;">Jumlah</th>
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
            // test($data_mutasi,1);
            $no       = 0;
            $tjumlah  = 0;
            $tstok    = 0;
            foreach ($data_aset as $key => $value) {
              $no         = $no+1;
              $jumlah     = $value->harga_perolehan*$value->jumlah;
              $tjumlah    = $tjumlah+$jumlah;
              $tstok      = $tstok+$value->jumlah;
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $value->lokasi; ?></td>
              <td><?php echo $value->kd_assets; ?></td>
              <td><?php echo $value->nama; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo $value->jumlah; ?></td>
              <td><?php echo $value->merk; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo $value->tahun_perolehan; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo ''; ?></td>
              <td><?php echo $value->sumber; ?></td>
              <td align="right"><?php echo number_format($value->harga_perolehan); ?></td>
              <td><?php echo ''; ?></td>
              <td align="right"><?php echo number_format($jumlah); ?></td>
              <td><?php echo $value->kondisi; ?></td>
              <td><?php echo ''; ?></td>
              <!-- <td align="center"><button type="submit" class="btn btn-xs btn-danger" id="delete" data-id_aset="<?php echo $value->id_assets; ?>" data-name="<?php echo $value->nama; ?>">Hapus</button>
                  <a href="<?php echo base_url('master/aset/edit/'.$value->id_assets); ?>" type="submit" class="btn btn-xs btn-warning">Edit</a></td> -->
            </tr>
            <?php 
            }
            ?>
            <tr>
              <td colspan="5" align="right">Jumlah</td>
              <td align="right"><?= number_format($tstok); ?></td>
              <td colspan="12"></td>
              <td align="right"><?= number_format($tjumlah); ?></td>
              <td colspan="2"></td>
            </tr>
          </table>