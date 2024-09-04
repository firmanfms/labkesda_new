<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
  // test($value,0);
}
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
<meta charset="utf-8">
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
                    <?php
                    echo headerkopsurat($agreditasi);
                    ?>
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
                <p style="line-height:2">Bersama ini kami sampaikan hasil pemeriksaan Sampel <?= $header->nm_sampel; ?> pada Laboratorium Lingkungan. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih. 
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
              <td align="Center">Dinas Kesehatan Kota Tangerang</td>
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
                  <?php echo footersurat($agreditasi)?>
                </td>
            </tr>
          </table>   
        </div> 
        <!-- <pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre> -->
        <p style="mso-special-character:line-break;page-break-before:always">&nbsp;</p>
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
                    <?php
                    echo headerkopsurat($agreditasi);
                    ?>
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
              <td colspan="4" align="center"><strong style="font-size: 13px;">Laporan Hasil Uji Lab Lingkungan</strong></td>
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
              <td>Nama Pelanggan</td>
              <td colspan="3">: <?php echo strtoupper($header->nama); ?></td>
            </tr>
            <tr>
              <td width="25%">No. Lab</td>
              <td width="35%">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="20%"></td>
              <td width="20%"></td>
            </tr>
            <tr>
              <td>Jenis Sampel</td>
              <td colspan="3">: <?php echo $header->nm_sampel; ?></td>
            </tr>
            <tr>
              <td>Jenis Analisa</td>
              <td colspan="3">: <?php echo $header->jns_analisa; ?></td>
            </tr>
            <tr>
              <td>Ketrangan / Kondisi Sampel</td>
              <td colspan="3">: <?php echo $header->ket_sampel.'/'.$header->kondisi; ?></td>
            </tr>
			<tr>
              <td>Lokasi Pengambilan Sampel</td>
              <td colspan="3">: <?php echo $header->lokasi; ?></td>
            </tr>
            <tr>
              <td>Tanggal Penerimaan</td>
              <td>: <?php echo tgl_singkat($header->tgl_diterima); ?></td>
              <td></td>
              <td></td>
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
                    <td width='20%' align="center">Jenis Pemeriksaan</td>
                    <td width='15%'  align="center">Hasil</td>
                    <td align="center">Nilai Rujukan</td>
                    <td align="center">Satuan</td>
                    <td align="center">Metode Uji</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td colspan="5">-- &nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?> --</td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                    $total    = $total+$value->harga;
                    $bold     = $value->nilai;
                    if($value->nilai_min!='0.00' AND $value->nilai_max!='0.00'){
                      if((int)$value->nilai < $value->nilai_min OR $value->nilai_max > (int)$value->nilai){
                      // if($value->nilai<$value->nilai_min OR $value->nilai>$value->nilai_max){
                        $bold     = $value->nilai;
                      }else{
                        $bold     = "<strong><u>".$value->nilai."</u></strong>";
                      }
                    }
                    ?>
                    <tr style="border: 1px solid black">
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->nm_parameter; ?></td>
                      <td align="center"><?php echo $bold; ?></td>
                      <td align="center"><?php echo $value->kadar; ?></td>
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
              <td colspan="4">
                <?php 
                if($header->sampel_ket!=''){
                  echo $header->sampel_ket;
                }else{
                  echo $note->keterangan;
                }
                ?>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="left" height='25'>
                <?= $note->catatan; ?>
              </td>                
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
  <!-- <div class="footer">
    <p style="margin-right: 100px;"></p>
  </div> -->
</section>
</head>
</meta>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->