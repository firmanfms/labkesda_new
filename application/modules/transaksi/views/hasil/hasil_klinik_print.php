<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
// test($detail,1);
foreach ($res_par as $key => $value) {
  // test($value,0);
}
// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment;Filename=".str_replace("/","",$header->no_pendaftaran).".doc");
$today = date("H:i:s");
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
    border-collapse: collapse !important;
    font-family: 'Times New Roman', Times, serif !important;
    font-size: 13px !important;
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
  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: right;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <?php 
        if($type_surat=="surat"){
        ?>
        <div class="box-body" style="page-break-before:always;">
          <table style="width:100%;font-family: initial;font-size: 13px" >
            <tr>
              <td colspan="4">
                <table style='width:100%;font-family: initial;'> 
                  <?php 
                  if($header_cetak=='Ya'){
                  ?>
                  <tr>
                    <td width='15%' align="center">                    
                      <img src="<?= base_url('assets/image/542px-Lambang_Kota_Tangerang.png') ?>" alt="" height="75" width='75'>
                    </td>
                    <td colspan="2" width='50%' align="center">
                      <strong style="font-size: 12px;">
                        PEMERINTAH KOTA TANGERANG<br/>
                        DINAS KESEHATAN<br/>
                        UPT LABORATORIUM KESEHATAN DAERAH<br/>
                      </strong>
                      <strong style="font-size: 12px;">
                        JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111<br/>
                        Email : labkeskota.tangerang@gmail.com
                      </strong>
                    </td>
                    <td width='35%' align="center">
                      <?php 
                      if($agreditasi=="kan"){
                      ?>
                        <img src="<?= base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') ?>" alt="" height="75" width='100'>
                      <?php
                      }else if($agreditasi=="kalk"){
                      ?>
                        <img src="<?= base_url('assets/image/logo-KALK.jpg') ?>" alt="" height="125" width='175'>
                      <?php
                      }else if($agreditasi=="kankalk"){
                      ?>
                        <img src="<?= base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') ?>" alt="" height="75" width='100'>
                        <img src="<?= base_url('assets/image/logo-KALK.jpg') ?>" alt="" height="75" width='100'>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                  <?php 
                  }else{
                  ?>
                  <tr>
                    <td colspan="4" align="center"><br/><br/><br/><br/><br/><br/></td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td width="15%">No. Lab</td>
              <td width="35%">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="25%" colspan="2" align="right">Tangerang, <?= tgl_print(dbnow()); ?></td>
            </tr>
            <tr>
              <td width="15%">Sifat</td>
              <td width="35%">: Rahasia</td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%">Perihal</td>
              <td width="35%">: Hasil Pemeriksaan Laboratorium</td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%" colspan="4">
                Kepada Yth,
              </td>
            </tr>
            <tr>
              <td width="15%" colspan="4" style="height:30">
                Bapak / Ibu <?php echo strtoupper($header->nama); ?>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left" style="height:30">
                <?= ucfirst($header->alamat); ?>
              </td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%" colspan="4" style="text-align: justify" style="height:30">
                <p style="line-height:2">Bersama ini kami sampaikan hasil pemeriksaan pada Laboratorium Klinik. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih. 
				</p>
			  </td>
            </tr>
            <tr>
              <td width="15%"><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center">Mengetahui, <br><?= ($ttn=="kalab")? $ttd_kepala->jabatan : $ttd_tu->jabatan; ?> </td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center">Dinas Kesehatan Kota Tangerang</td>
            </tr>
            <tr>
              <td width="15%"><br/><br/><br/></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center"></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center"><u><?= ($ttn=="kalab")? $ttd_kepala->nama : $ttd_tu->nama; ?></u></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="25%" align="right"></td>
              <td width="25%" align="Center">NIP. <?= ($ttn=="kalab")? $ttd_kepala->nip : $ttd_tu->nip; ?></td>
            </tr>
          </table>
        </div>
        <?php
        }
        if($type_laporan=='laporan'){
        ?>
        <div class="box-body" style="page-break-before:always;">
          <table style="width:100%;font-family: initial;font-size: 13px">
            <tr>
              <td colspan="4">
                <table style='width:100%;font-family: initial;'> 
                  <?php 
                  if($header_cetak=='Ya'){
                  ?>
                  <tr>
                    <td width='15%' align="center">                    
                      <img src="<?= base_url('assets/image/542px-Lambang_Kota_Tangerang.png') ?>" alt="" height="75" width='75'>
                    </td>
                    <td colspan="2" width='50%' align="center">
                      <strong style="font-size: 12px;">
                        PEMERINTAH KOTA TANGERANG<br/>
                        DINAS KESEHATAN<br/>
                        UPT LABORATORIUM KESEHATAN DAERAH<br/>
                      </strong>
                      <strong style="font-size: 12px;">
                        JL. TMP Taruna Suka Asih Telp/Fax : 021 - 5588737 Kota Tangerang 15111<br/>
                        Email : labkeskota.tangerang@gmail.com
                      </strong>
                    </td>
                    <td width='35%' align="center">
                      <?php 
                      if($agreditasi=="kan"){
                      ?>
                        <img src="<?= base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') ?>" alt="" height="75" width='100'>
                      <?php
                      }else if($agreditasi=="kalk"){
                      ?>
                        <img src="<?= base_url('assets/image/logo-KALK.jpg') ?>" alt="" height="125" width='175'>
                      <?php
                      }else if($agreditasi=="kankalk"){
                      ?>
                        <img src="<?= base_url('assets/image/kan-logo-D754581922-seeklogo.com.png') ?>" alt="" height="75" width='100'>
                        <img src="<?= base_url('assets/image/logo-KALK.jpg') ?>" alt="" height="75" width='100'>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                  <?php 
                  }else{
                  ?>
                  <tr>
                    <td colspan="4" align="center"><br/><br/><br/><br/></td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
          </table>
          <table style="width:100%;font-family: initial;font-size: 13px">
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 14px;">Laporan Hasil Uji Lab Klinik</strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 12px;">NOMOR : <?php echo $header->no_pendaftaran; ?></strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td width="15%">No. Lab</td>
              <td width="35%">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="25%">Dokter</td>
              <td width="25%">: <?php echo $header->dokter; ?></td>
            </tr>
            <tr>
              <td>Nama Pasien</td>
              <td>: <?php echo strtoupper($header->nama); ?></td>
              <td>Waktu Pengambilan Spesimen</td>
              <td>: <?php echo tgl_singkat_waktu($header->tgl_spesimen); ?></td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>: <?php echo tgl_singkat($header->tgl_lahir); ?></td>
              <td>Jenis Kelamin</td>
              <td>: <?= ($header->jns_kelamin=='W')? 'Wanita' : 'Pria' ; ?></td>
            </tr>
            <tr>
              <td>Umur</td>
              <td>: <?php echo $umur.' Tahun'.' '.$month.' Bulan'.' '.$day.' Hari'; ?></td>
              <td>Keterangan</td>
              <td>: <?php echo $header->keterangan; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?php echo $header->alamat; ?></td>
              <!-- <td>Kondisi</td>
              <td>: <?php echo $header->kondisi; ?></td> -->
            </tr>
            <tr>
              <td colspan="4" align="left">
                <?= ($napsa=='ya')? 'Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut : ' : '<br/>'; ?>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td colspan="4">
                <table style="width:100%;font-family: initial;border: 1px solid black;font-size: 13px">
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td width='20%' align="center">Jenis Pemeriksaan</td>
                    <td width='15%'  align="center">Hasil</td>
                    <td align="center">Nilai Rujukan</td>
                    <td align="center">Satuan</td>
                    <td align="center">Metode Uji</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  // test($detail_kdpar,1);
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td colspan="5">-- &nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?> --</td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                      // pre($value);exit();
                    $total    = $total+$value->harga;
                    $bold     = $value->nilai;
                    $nilai_min = (float)$value->nilai_min;
                    if($nilai_min==0.00){
                      $nilai_min = (float)0.01;
                    }
                    $nilai_max = (float)$value->nilai_max;
                    if($nilai_max==0.00){
                      $nilai_max = (float)0.01;
                    }
                    if($value->nilai_min!='0.00' AND $value->nilai_max!='0.00'){
                      if(floatval($value->nilai)<$nilai_min OR floatval($value->nilai)>$nilai_max){
                        $bold     = "<strong><u>".$value->nilai."</u></strong>";
                      }else{
                        $bold     = $value->nilai;
                      }
                    }
                    ?>
                    <tr style="border: 1px solid black">
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->nm_parameter; ?></td>
                      <td align="center">
                        <?php echo $bold.' <br/> Min : '.gettype($nilai_min).' '.$nilai_min.' <br/> Max :'.gettype($nilai_max).' '.$nilai_max; ?>
                        </td>
                      <!-- <td align="center"><?php echo $value->deskripsi_kadar; ?></td> -->
                      <td align="center"><?php echo $value->kadar2; ?></td>
                      <td align="center"><?php echo $value->satuan; ?></td>
                      <td align="center"><?php echo $value->hasil_analisa; ?></td>
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
              <td colspan="4">
                <?= ($napsa=='ya')? $note->keterangan:""; ?>
              </td>
            </tr>
          </table>
          <table class="break" style="width:100%;font-size: 13px;">
            <tr>
              <td><br/></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="3" align="center">
              </td>
              <td colspan="1" align="center"></br>
              Tangerang, <?= tgl_print(dbnow()); ?></br></br>
			  Mengetahui, </br>
              <?= ($ttl=='matek')? $ttd_teknis->jabatan:$ttd_koor->jabatan; ?></br></br></br></br></br>
              <u><?= ($ttl=='matek')? $ttd_teknis->nama:$ttd_koor->nama; ?></u></br>
              NIP. <?= ($ttl=='matek')? $ttd_teknis->nip:$ttd_koor->nip; ?>
              </td>
            </tr>
            <tr>
              <td height='10' width='25%'></td>
              <td width='25%'></td>
              <td width='25%'></td>
              <td width='25%'></td>
            </tr>
            <tr>
                <td colspan="3" align="left" >
                  <?= $note->catatan; ?>
                </td>
                <td colspan="1" align="right"></td>
            </tr>
            <tr>
                <td colspan="3" align="left" >
                </td>
                <td colspan="1" align="right"></td>
            </tr>
          </table>
        </div>
        <?php 
        }
        ?>
      </div>
    </div>
  </div>
  <div class="footer">
    <p style="margin-right: 100px;">FSOP.LKT-15.1</p>
  </div>
</section>
</head>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->