<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
  // test($value,0);
}
$today = $this->db->query("SELECT CURRENT_TIME() as today")->row()->today;
?>
<style>
  @media print{
    .break {
      break-inside: avoid;
    }
  /*@page {
    size: portrait;
    }
  }*/
  }
  @page {
    /*size: A4;
    margin: 0;*/
    size: Legal portrait;
    margin: 0.4in
  }
  table{
    border-collapse: collapse;
    font-family: arial;
  }
  td {
    vertical-align: top;
  }
  .borderluar {
    border: 2px solid black;
    padding: 0px;
  }
  .borderdalem {
    border: 1px solid #000000b0;
    padding: 0px;
  }
  .borderdalemcenter {
    border: 1px solid #000000b0;
    padding: 0px;
    text-align: center;
  }
  .borderdalemangka {
    border: 1px solid #000000b0;
    padding: 0px 5px;
    text-align: right;
  }
  .borderdalemangka_detail {
    padding: 0px 5px;
  }
  .bordertengah {
    border: 1px solid #000000b0;
    padding: 5px 5px 5px 5px; 
  }
  p.two {
    border-style: solid;
    border-width: 1px;
  }
  .header{
    padding: 0px 30px; 
    text-align: center;
  }
  .header_alamat {
    border: 2px solid black;
    padding: 0px 30px; 
    text-align: center;
  }
  .table_detail {
    border-collapse: collapse;
    border: 1px solid black;
  }
  hr {
    border-bottom: 2px solid black;
    box-shadow: 0px 5px 0 black;
  }
  .table {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table style="width:100%;font-family: initial;">
            <tr>
              <td colspan="4">
                <table style='width:100%;font-family: initial;'> 
                  <tr>
                    <td align="center" colspan="2" width='20%' valign="bottom">
                      <img src="<?= base_url('assets/image/542px-Lambang_Kota_Tangerang.png') ?>" alt="" height="100" width='100'>
                    </td>
                    <td colspan="2" width='80%' align="center">
                      <strong style="font-size: 19px;">
                        PEMERINTAH KOTA TANGERANG<br/>
                        DINAS KESEHATAN<br/>
                        UPT LABORATORIUM KESEHATAN DAERAH<br/>
                      </strong>
                      <strong>
                        JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111<br/>
                        Email : labkeskota.tangerang@gmail.com
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 22px;">Invoice Pengujian Sampel Lingkungan</strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td width="15%">No. Lab</td>
              <td width="45%">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="15%">Jenis Analisa</td>
              <td width="25%">: <?php echo $header->jns_analisa; ?></td>
            </tr>
            <tr>
              <td>Pemilik</td>
              <td>: <?php echo ucwords(strtolower($header->nama));?></td>
              <td>Keterangan Sampel</td>
              <td>: <?php echo $header->ket_sampel; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?php echo $header->alamat; ?></td>
              <td>Tgl. Diterima</td>
              <td>: <?php echo tgl_singkat($header->tgl_diterima).' '.$today; ?></td>
            </tr>
            <tr>
              <td>Telepon</td>
              <td>: <?php echo $header->telp; ?></td>
              <td>Tgl. Pengujian</td>
              <td>: <?php echo tgl_singkat($header->tgl_pengujian); ?></td>
            </tr>
            <tr>
              <td>Jenis Sampel</td>
              <td>: <?php echo $header->nm_sampel; ?></td>
              <td>Tgl. Selesai</td>
              <td>: <?php echo tgl_singkat($header->tgl_selesai); ?></td>
            </tr>
            <tr>
                    <td>Volume Spesimen</td>
                    <td>: <?php echo $header->volume; ?></td>
                    <td>Lokasi Sampel</td>
                    <td>: <?php echo $header->lokasi; ?></td>
                  </tr>
			<tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td colspan="4">
                <table style="width:100%;font-family: initial;border: 1px solid black;">
                  <tr style="border: 1px solid black;">
                    <td>Parameter</td>
                    <td>Jenis Pemeriksaan</td>
                    <td>Keterangan</td>
                    <td width="10%">Harga</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black">
                    <td colspan="4">--&nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?></td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                    $total    = $total+$value->harga;
                    ?>
                    <tr>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->nm_parameter; ?></td>
                      <td><?php echo $value->metode_analisa; ?></td>
                      <td><?php echo $value->ket; ?></td>
                      <td align="right"><?php echo money($value->harga); ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                  <?php 
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="3" align="right">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td align="right"><?php echo money($total); ?></td>
            </tr>
            <tr>              
              <td colspan="4" align="left"><br>
                Note : 
                <ul>
                  <li>Labkesda berhak melakukan perubahan metode apabila diperlukan.</li>
                  <li>Pemohon tidak dapat mengubah identitas sampel yang sudah terdaftar</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left"><br/>
                <!-- LABKESDA BERHAK MELAKUKAN PERUBAHAN METODE APABILA DIPERLUKAN<br/> -->
              </td>
            </tr>
            <tr>
              <td colspan="4" >
                Uji Ulang Permintaan, Tender dan Kontrak
                <table width="70%">
                  <tr>
                    <td class="table" align="center">Metode</td>
                    <td class="table" align="center">Alat</td>
                    <td class="table" align="center">Personil</td>
                    <td class="table" align="center">Kondisi Akomodasi</td>
                    <td class="table" align="center">Bahan Kimia</td>
                    <td class="table" align="center">Ttd</td>
                  </tr>
                  <tr>
                    <td class="table" width="15%" height="50px"></td>
                    <td class="table" width="15%"></td>
                    <td class="table" width="15%"></td>
                    <td class="table" width="15%"></td>
                    <td class="table" width="15%"></td>
                    <td class="table" width="15%"></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" >
              </td>
              <td valign="bottom" align="center">Pemohon</td>
              <td valign="bottom" >Tangerang, <?= /*tgl_singkat($header->tgl_input)*/tgl_singkat(dbnow()); ?><br/>Bagian Penerima Sampel</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td align="center"><br/><br/><br/><br/><br/>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
              <td ><br/><br/><br/><br/><br/>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
</head>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->