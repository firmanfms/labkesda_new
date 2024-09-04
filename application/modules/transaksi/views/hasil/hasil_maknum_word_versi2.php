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
    .break {
      break-inside: avoid;
    }
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
              <td colspan="2" align="right"></td>
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
        <div class="box-body">
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
                    <td colspan="4" align="center" style="height:100"></td>
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
            <tr>
              <td colspan="4" align="left">
              </td>
            </tr>
            <tr>
              <td width="20%" valign="top">No. Lab</td>
              <td width="30%" valign="top">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="20%" valign="top">Alamat</td>
              <td width="30%" valign="top"><?php echo $header->alamat; ?></td>
            </tr>
            <tr>
              <td valign="top">Pemilik</td>
              <td valign="top">: <?php echo strtoupper($header->nama); ?></td>
              <td valign="top">Jenis Sampel</td>
              <td valign="top">: <?php echo $header->nm_sampel; ?></td>
            </tr>
            <tr>
              <td valign="top">Nama Sampel</td>
              <td valign="top">: <?php echo $header->uraian_sampel; ?></td>
              <td valign="top">Tanggal Penerimaan</td>
              <td valign="top">: <?php echo tgl_singkat($header->tgl_diterima); ?></td>
            </tr>
            <tr>
              <td valign="top">Banyak Sampel</td>
              <td valign="top">: <?php echo $header->banyak; ?></td>
              <td valign="top">Ketrangan Sampel</td>
              <td valign="top">: <?php echo $header->ket_sampel.'/'.$header->kondisi; ?></td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td colspan="4">
                <table style="width:100%;font-family: 'Times New Roman', Times, serif;border: 1px solid black;font-size: 13px" border='1'>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td class="table" width='15%' align="center" rowspan="2" colspan="2"> JENIS PEMERIKSAAN</td>
                    <td class="table" width='15%' align="center" rowspan="2">HASIL</td>
                    <td class="table" align="center" colspan="4">Maksimum Range (*) </td>
                    <td class="table" align="center" rowspan="2" width='15%'>METODE UJI</td>
                    <td class="table" align="center" rowspan="2" width='10%'>KET </td>
                  </tr>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600;border-collapse: collapse;">
                    <td class="table" width="6%" align="center">n</td>
                    <td class="table" width="6%" align="center">c</td>
                    <td class="table" width="6%" align="center">m</td>
                    <td class="table" width="7%" align="center">M</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td colspan="9">-- &nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?> --</td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                      $total      = $total+$value->harga;
                      // $data_nilai = explode ("|",$value->nilai);
                      // test($data_nilai,0);
                      $nilai      = str_replace("|","<br/>",$value->nilai);
                      $nilai_ex   = explode("|",$value->nilai);
                      $nilai_leng = count($nilai_ex); 
                      $kadar      = explode("|",$value->kadar);
                      // test($nilai_leng,1);
                      $bold     = $nilai_ex[0];
                      if($value->nilai_min!='0.00' AND $value->nilai_max!='0.00'){
                        if((int)$nilai_ex[0] < $value->nilai_min OR $value->nilai_max > (int)$nilai_ex[0]){
                          if($nilai_ex[0] > $value->nilai_min AND $value->nilai_max > $nilai_ex[0]){
                            $bold     = $nilai_ex[0];
                          }else{
                            $bold     = "<strong><u>".$nilai_ex[0]."</u></strong>";
                          }
                        }
                      }
                      ?>
                      <tr style="border: 0px solid black">
                        <td class="border_kosong" valign='top' colspan="2"><?php echo $value->nm_parameter; ?></td>
                        <!-- <td class="border_kosong"><?= $value->ket; ?></td> -->
                        <td class="table" valign='top' ><?php echo $bold; ?></td>
                        <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= @$kadar[0]; ?></td>
                        <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= @$kadar[1]; ?></td>
                        <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= @$kadar[2]; ?></td>
                        <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= @$kadar[3]; ?></td>
                        <td class="table" valign='top' rowspan="<?= $nilai_leng; ?>"><?php echo $value->hasil_analisa; ?></td>
                        <td class="table" valign='top' rowspan="<?= $nilai_leng; ?>"><?php echo $value->ket; ?></td>
                      </tr>
                      <?php 
                        for ($i=1; $i < $nilai_leng ; $i++) {
                        echo "<tr>";                        
                          echo '<td class="">&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                          // echo '<td class="" valign="top">'.$value->ket.'</td>';
                          echo '<td class="table" valign="top" colspan="2">'.$nilai_ex[$i].'</td>';
                        echo "</tr>";
                        }
                      ?>
                    <?php 
                    }
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
                <td colspan="4"><?= $note->keterangan; ?></td>
            </tr>
            </table>
          <table class="break" style="width:100%;font-family: 'Times New Roman', Times, serif;font-size: 13px">
            <tr>
              <td colspan="2" align="center" width='50%'></td>
              <td colspan="2" align="center" width='50%'>Tangerang, <?= tgl_print(dbnow()); ?>
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
                <td colspan='4'>Catatan :</td>
            </tr>
            <tr>
                <td colspan='4'>- Pemeriksa tidak bertanggung jawab atas pengambilan sampel</td>
            </tr>
            <tr>
                <td colspan='4'>- Hasil Analisa diatas hanya berlaku untuk sampel yang dikirim</td>
            </tr>
            <tr>
                <td colspan='4'>- Laporan ini tidak boleh di cetak ulang sebagian</td>
            </tr>
            <tr>
                <td colspan='4'>- Pencetakan ulang Melalu persetujuan Labkesda</td>
            </tr>
            <tr>
                <td colspan='3' align="right"></td>
                <td align="right">FSOP.LKT-15.1.LM</td>
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
          <!-- <table border="1">
            <tr>
              <td rowspan="4"> 1 </td>
              <td> 2 </td>
              <td rowspan="4"> 3 </td>
              <td rowspan="4"> 4 </td>
              <td rowspan="4"> 5 </td>
              <td rowspan="4"> 6 </td>
            </tr>
            <tr>
              <td> 2 </td>
            </tr>
            <tr>
              <td> 2 </td>
            </tr>
            <tr>
              <td> 2 </td>
            </tr>
            <tr>
              <td> 1 </td>
              <td> 2 </td>
              <td> 3 </td>
              <td> 4 </td>
              <td> 5 </td>
              <td> 6 </td>
            </tr>
          </table> -->
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