<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
  // test($value,0);
}
// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment;Filename=Invoice-.doc");
$today = $this->db->query("SELECT CURRENT_TIME() as today")->row()->today;
$tanggal_lahir  = date('Y-m-d', strtotime($header->tgl_lahir));
$tgl_input      = date('Y-m-d', strtotime($header->tgl_input));
$birthDate      = new \DateTime($tanggal_lahir);
$tgl_input      = new \DateTime($tgl_input);
$umur           = 0;
if ($birthDate < $tgl_input) {
  $umur       = $tgl_input->diff($birthDate)->y;
  $month      = $tgl_input->diff($birthDate)->m;
  $day        = $tgl_input->diff($birthDate)->d;
}
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
              <td colspan="4" align="center"><strong style="font-size: 22px;">  Invoice Pengujian Sampel Klinik</strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td width="15%" valign="top">No. Lab</td>
              <td width="45%" valign="top">: <?php echo $header->no_pendaftaran; ?></td>
              <td valign="15%">Dokter</td>
              <td valign="25%">: <?php echo $header->dokter; ?></td>
            </tr>
            <!-- <tr>
              <td>Jenis Analisa</td>
              <td>: <?php echo $header->jns_analisa; ?></td>
              <td>Keterangan Sampel</td>
              <td>: <?php echo $header->ket_sampel; ?></td>
            </tr> -->
            <tr>
              <td valign="top">Nama</td>
              <td valign="top">: <?php echo ucwords(strtolower($header->nama));?></td>
              <td valign="top">Jenis Spesimen</td>
              <td valign="top">: <?php echo $header->jenis_spesimen; ?></td>
            </tr>
            <tr>
              <td valign="top">Alamat</td>
              <td valign="top">: <?php echo $header->alamat; ?></td>
              <td valign="top">Diagnosa</td>
              <td valign="top">: <?php echo $header->diagnosa_klinik; ?></td>
            </tr>
            <tr>
              <td valign="top">Umur</td>
              <td valign="top">: <?php echo $umur.' Tahun'.' '.$month.' Bulan'.' '.$day.' Hari'; ?></td>
              <td valign="top">Tgl. Diterima</td>
              <td valign="top">: <?php echo tgl_singkat($header->tgl_diterima).' '.$today; ?></td>
            </tr>
            <tr>
              <td valign="top">Tgl Lahir</td>
              <td valign="top">: <?php echo tgl_singkat($header->tgl_lahir); ?></td>
              <td valign="top">Tgl. Selesai</td>
              <td valign="top">: <?php echo tgl_singkat($header->tgl_selesai); ?></td>
            </tr>
            <tr>
              <td valign="top">Telepon</td>
              <td valign="top">: <?php echo $header->telp; ?></td>
              <td valign="top">Volume Sampel</td>
              <td valign="top">: <?php echo tgl_singkat($header->volume); ?></td>
            </tr>
            <tr>
              <td valign="top">Jenis Kelamin</td>
              <td valign="top">: <?php echo ($header->jns_kelamin=='W')? 'Wanita' : 'Pria'; ?></td>
              <td valign="top">Lokasi Pengambilan Spesimen</td>
              <td valign="top">: <?php echo $header->lokasi; ?></td>
            </tr>
            <tr>  
            <td valign="top">Keterangan</td>
              <td valign="top">: <?= $header->keterangan; ?></td>
              <td><!--Jenis Sampel --></td>
              <td><!--: <?php echo $header->kd_sampel; ?> --></td>
            </tr>
            <tr>              
              <td><!--Kondisi --></td>
              <td><!-- : <?php echo $header->kondisi; ?> --></td>
              <td><!--Jenis Sampel --></td>
              <td><!--: <?php echo $header->kd_sampel; ?> --></td>
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
                  <tbody class="pagebreak">
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black" >
                    <td colspan="4">--&nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?></td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                    $total    = $total+$value->harga;
                    ?>
                    <tr >
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
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="3" align="right">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td align="right"><?php echo money($total); ?></td>
            </tr>
            <tr>
              <td colspan="4" align="center">
                PERSETUJUAN PENGAMBILAN SPESIMEN <br/>
                Dengan ini kami menyatakan setuju untuk dilakukan pengambilan spesimen darah vena/darah kapiler/urin/tinja sesuai prosedur yang telah ditetapkan oleh UPTD Laboratorium Kesehatan Kota Tangerang <br/>
              </td>
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