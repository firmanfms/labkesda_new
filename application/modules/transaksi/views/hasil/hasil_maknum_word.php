<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
// test($res_par,1);
foreach ($res_par as $key => $value) {
  // test($value,0);
}
// pre( $res_par);exit();
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=".str_replace("/","",$header->no_pendaftaran).".doc");
?>
<style>
  @media print{
    @page {
/*      size: portrait;*/
      size: A4;
      margin-right: 0.5cm;
      margin-left: 0.5cm;        
      }
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
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <?php 
        if($type_surat=="surat"){
        ?>
        <div class="box-body" style="page-break-before:always;">
          <table style="width:100%;font-family: initial;font-size: 13.5px" >
            <tr>
              <td colspan="4">
                <table style='width:100%;font-family: initial;'> 
                  <?php 
                  if($header_cetak=='Ya'){
                  ?>
                  <tr>
                   <?php echo  headerkopsurat($agreditasi); ?>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                  <?php 
                  }else{
                  ?>
                  <tr>
                    <td colspan="4" align="center" height="70">
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td>No. Lab</td>
              <td>: <?php echo $header->no_pendaftaran; ?></td>
              <td colspan="2" align="right">Tangerang, <?= tgl_print(dbnow()); ?></td>
            </tr>
            <tr>
              <td>Sifat</td>
              <td>: Rahasia</td>
              <tdcolspan="2" align="right"></td>
            </tr>
            <tr>
              <td>Perihal</td>
              <td>: Hasil Pemeriksaan Laboratorium</td>
              <td colspan="2" align="right"></td>
            </tr>
            <tr>
              <td style="height:30"></td>
              <td></td>
              <td colspan="2" align="right"></td>
            </tr>
            <tr>
              <td colspan="4">
                Kepada Yth,
              </td>
            </tr>
            <tr>
              <td colspan="4" style="height:30">
                Bapak / Ibu <?php echo strtoupper($header->nama); ?>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left" style="height:30">
                <?= ucfirst($header->alamat); ?>
              </td>
            </tr>
            <tr>
              <td><br/><br/></td>
              <td></td>
              <td colspan="2" align="right"></td>
            </tr>
            <tr>
              <td width="15%" colspan="4" style="text-align: justify" style="height:30">
                <p style="line-height:2">
				Bersama ini kami sampaikan hasil pemeriksaan Sampel <?= $header->nm_sampel; ?> pada Laboratorium Makanan Dan Minuman. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih. 
				</p>
			  </td>
            </tr>
            <tr>
              <td  style="height:30"></td>
              <td ></td>
              <td  colspan="2" align="right"></td>
            </tr>
			<tr>
              <td ></td>
              <td ></td>
              <td align="right"></td>
              <td align="Center"></td>
            </tr>
			<tr>
              <td ></td>
              <td ></td>
              <td align="right"></td>
              <td align="Center">Mengetahui,</td>
            </tr>
            <tr>
              <td ></td>
              <td ></td>
              <td align="right"></td>
              <td align="Center"><?= ($ttn=="kalab")? $ttd_kepala->jabatan : $ttd_tu->jabatan; ?></td>
            </tr>
            <tr>
              <td ></td>
              <td ></td>
              <td align="right"></td>
              <td align="Center">Kota Tangerang</td>
            </tr>
            <tr>
              <td style="height:50"></td>
              <td></td>
              <td align="right"></td>
              <td align="Center"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td align="right"></td>
              <td align="Center"><u><?= ($ttn=="kalab")? $ttd_kepala->nama : $ttd_tu->nama; ?></u></td>
            </tr>
            <tr>
              <td width="15%"></td>
              <td width="35%"></td>
              <td width="10%" align="right"></td>
              <td width="40%" align="Center">NIP. <?= ($ttn=="kalab")? $ttd_kepala->nip : $ttd_tu->nip; ?></td>
            </tr>
            <tr>
              <td style="height:50"></td>
              <td></td>
              <td align="right"></td>
              <td align="right">FSOP.LKT-15.1</td>
            </tr>
            <tr>
                  <td colspan="4">
                  <?php echo footersurat($agreditasi); ?>
                </td>
            </tr>
          </table>
        </div> 
        <pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
        <p style="page-break-after: always;">&nbsp;</p>
        <?php 
        }
        if($type_laporan=='laporan'){
        ?> 
        <div class="box-body" style="page-break-before:always;">
          <table style="width:100%;font-family: 'Times New Roman', Times, serif;font-size: 13px">
            <tr>
              <td colspan="4">
                <table style="width:100%;font-family: 'Times New Roman', Times, serif;"> 
                  <?php 
                  if($header_cetak=='Ya'){
                  ?>
                  <tr>
                   <?php echo  headerkopsurat($agreditasi); ?>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><hr/></td>
                  </tr>
                  <?php 
                  }else{
                  ?>
                  <tr>
                    <td colspan="4" align="center" height="100">
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 13px;">Laporan Hasil Uji Lab Makanan Dan Minuman</strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 13px;">NOMOR : <?php echo $header->no_pendaftaran; ?></strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
			<!--
            <tr>
              <td colspan="4" align="center">
                Yang bertanda tangan di bawah ini menyatakan bahwa hasil uji :
              </td>
            </tr>
			-->
            <tr>
              <td width="15%" valign="top">No. Lab</td>
              <td width="35%" valign="top">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="20%" valign="top">Volume</td>
              <td width="30%" valign="top">: <?php echo $header->banyak; ?></td>
            </tr>
            <tr>
              <td valign="top">Pemilik</td>
              <td valign="top">: <?php echo strtoupper($header->nama); ?></td>
              <td valign="top">Jenis Sampel</td>
              <td valign="top">: <?php echo $header->nm_sampel; ?></td>
            </tr>
			<tr>
              <td valign="top">Alamat</td>
              <td valign="top">: <?php echo $header->alamat; ?></td>
              <td valign="top">Tanggal Penerimaan</td>
              <td valign="top">: <?php echo tgl_singkat($header->tgl_diterima); ?></td>
            </tr>
            <tr>
              <td valign="top">Nama Sampel</td>
              <td valign="top">: <?php echo $header->uraian_sampel; ?></td>
              <td valign="top">Keterangan Sampel</td>
              <td valign="top">: <?php echo $header->ket_sampel.'/'.$header->kondisi; ?></td>
            </tr>
            <tr>
              <td valign="top"></td>
              <td valign="top"></td>
              <td valign="top"></td>
              <td valign="top"></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
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
                <table style="width:100%;font-family: 'Times New Roman', Times, serif;border: 1px solid black;font-size: 13px" border='1'>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td width='30%' align="center" colspan="2"> Pemeriksaan</td>
                    <td width='15%'>Hasil Pemeriksaan</td>
                    <td>Kadar Maksimum yang Diperbolehkan </td>
                    <td>Metode Uji</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value1) {
                  // pre($res_par[$value1->kd_kategori_parameter],1);
                  $nm_kategori_parameter     = $value1->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td colspan="5">-- &nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?> --</td>
                  </tr>
                    <?php
                    foreach ($res_par[$value1->kd_kategori_parameter] as $key => $value) {
                    $total    = $total+$value->harga;
                    $nilai1   = substr($value->nilai,0,1);
                    if($nilai1==">" OR $nilai1=="<"){
                      $nilai2    = substr($value->nilai,0,1).' '.substr($value->nilai,1,300);
                    }else{
                      $nilai2    = $value->nilai;
                    }
                    $kadar1   = substr($value->kadar,0,1);
                    if($nilai1==">" OR $nilai1=="<"){
                      $kadar2    = substr($value->kadar,0,1).' '.substr($value->kadar,1,300);
                    }else{
                      $kadar2    = $value->kadar;
                    }
                    $nilai    = str_replace("|","<br/>",$nilai2);
                    $bold     = $nilai;
                    if($value->nilai_min!='0.00' AND $value->nilai_max!='0.00'){
                      if((int)$value->nilai < $value->nilai_min OR $value->nilai_max > (int)$value->nilai){
                      // if($nilai2 > $value->nilai_min AND $value->nilai_max > $nilai2){
                        $bold     = $nilai;
                      }else{
                        $bold     = "<strong><u>".$nilai."</u></strong>";
                      }
                    }
                    ?>
                    <tr style="border: 1px solid black">
                      <td colspan="2"><?php echo $value->nm_parameter; ?></td>
                      <!--<td><?php //echo $value->ket; ?></td>-->
                      <td align="center"><?= $bold; ?></td>
                      <td align="center"><?= $kadar2; ?></td>
                      <td align="center"><?= $value->hasil_analisa; ?></td>
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
              <td colspan="2" align="center"></td>
              <td colspan="2" align="center">Tangerang, <?= tgl_print(dbnow()); ?>
              </td>
            </tr>
			<tr>
              <td colspan="2" align="center" height="5"></td>
              <td colspan="2" align="center" height="5"></td>
            </tr>
			<tr>
              <td colspan="2" align="center"></td>
              <td colspan="2" align="center">Mengetahui,</td>
            </tr>
            <tr>
              <td colspan="2" align="center"></td>
              <td colspan="2" align="center">
              <?= ($ttl=='matek')? $ttd_teknis->jabatan:$ttd_koor->jabatan; ?>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left" height='80'></td>                
            </tr>
            <tr>
              <td colspan="2" align="center"></td>
              <td colspan="2" align="center">
              <u><?= ($ttl=='matek')? $ttd_teknis->nama:$ttd_koor->nama; ?></u>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"></td>
              <td colspan="2" align="center" height="25">
              NIP. <?= ($ttl=='matek')? $ttd_teknis->nip:$ttd_koor->nip; ?>
              </td>
            </tr>
            <tr>
                <td colspan="4"><?= $note->keterangan; ?></td>
            </tr>
            <tr>
                <td colspan="4"><?= $note->catatan; ?></td>
            </tr>
            <tr>
              <td colspan="4">
                <div style="text-align:right;">
                  FSOP.LKT-15.1
                </div>
              </td>
            </tr>
            <tr>
                  <td colspan="4">
                  <?php 
				  //echo footersurat($agreditasi); 
				   echo footerlaporan($agreditasi);
				  ?>
                </td>
            </tr>
          </table>
        </div>
        <?php 
        }
        ?>
      </div>
    </div>
  </div>
</section>
</head>
</meta>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->