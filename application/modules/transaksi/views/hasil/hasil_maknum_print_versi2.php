<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
  // test($value,0);
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
  .table {
    border: 1px solid black;
    border-collapse: collapse;
  }
  .table_kosong {
    border: 0px solid black;
    border-collapse: collapse;
  }
  .border_kosong {
    border-top: 1px solid black ;
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
                    <td colspan="4" align="center"><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
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
                <p style="line-height:2">
        Bersama ini kami sampaikan hasil pemeriksaan Sampel <?= $header->nm_sampel; ?> pada Laboratorium Makanan Dan Minuman. Atas perhatian dan kerjasamanya, kami sampaikan terimakasih. 
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
          <table style="width:100%;font-family: initial;">
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
                    <td colspan="4" align="center"><br/><br/><br/><br/><br/><br/><br/></td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 14px;">Laporan Hasil Uji Lab Makanan Dan Minuman</strong></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><strong style="font-size: 12px;">NOMOR : <?php echo $header->no_pendaftaran; ?></strong></td>
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
              <td width="30%" valign="top">: <?php echo $header->alamat; ?></td>
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
            <!-- <tr>
              <td valign="top">No. Telp</td>
              <td valign="top">: <?php echo $header->telp; ?></td>
              <td valign="top"></td>
              <td valign="top"></td>
            </tr> -->
            <tr>
              <td colspan="4" align="left">
                <!-- <?= ($napsa=='ya')? 'Berdasarkan pemeriksaan saat ini, hasil untuk URINE SCREENING TEST, adalah sebagai berikut : ' : '<br/>'; ?> -->
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center" height="10"></td>
            </tr>
            <tr>
              <td colspan="4">
                <table style="width:100%;font-family: initial;border: 1px solid black;font-size: 13px;border-collapse: collapse;">
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600;border-collapse: collapse;">
                    <td class="table" width='24%' align="center" rowspan="2" colspan="2"> JENIS PEMERIKSAAN</td>
                    <td class="table" width='15%' align="center" rowspan="2">HASIL</td>
                    <td class="table" align="center" colspan="4">Maksimum Range (*) </td>
                    <td class="table" align="center" rowspan="2" width='15%'>METODE UJI</td>
                    <td class="table" align="center" rowspan="2" width='15%'>KET </td>
                  </tr>
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600;border-collapse: collapse;">
                    <td class="table" width="3%" align="center">n</td>
                    <td class="table" width="3%" align="center">c</td>
                    <td class="table" width="3%" align="center">m</td>
                    <td class="table" width="5%" align="center">M</td>
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
                      // if($nilai_ex[0] > $value->nilai_min AND $value->nilai_max > $nilai_ex[0]){
                        $bold     = $nilai_ex[0];
                      }else{
                        $bold     = "<strong><u>".$nilai_ex[0]."</u></strong>";
                      }
                    }
                    ?>
                    <tr style="border: 0px solid black">
                      <td class="border_kosong" valign='top' colspan="2"><?php echo $value->nm_parameter; ?></td>
                      <!-- <td class="border_kosong"><?= $value->ket; ?></td> -->
                      <td class="table" valign='top' ><?php echo $bold; ?></td>
                      <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= $kadar[0]; ?></td>
                      <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= $kadar[1]; ?></td>
                      <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= $kadar[2]; ?></td>
                      <td class="table" valign='top' align="center" rowspan="<?= $nilai_leng; ?>"><?= $kadar[3]; ?></td>
                      <td class="table" valign='top' rowspan="<?= $nilai_leng; ?>"><?php echo $value->hasil_analisa; ?></td>
                      <td class="table" valign='top' rowspan="<?= $nilai_leng; ?>"><?php echo $value->ket; ?></td>
                    </tr>
                    <?php 
                    for ($i=1; $i < $nilai_leng ; $i++) {

                      // $bold     = '';
                      // if($value->nilai<$value->nilai_min OR $value->nilai>$value->nilai_max){
                      //   $bold     = $nilai_ex[$i];
                      // }else{
                      //   $bold     = "<strong>".$nilai_ex[$i]."</strong>";
                      // }

                      echo "<tr>";                        
                        echo '<td class="">&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        // echo '<td class="" valign="top">'.$value->ket.'</td>';
                        echo '<td class="table" valign="top" colspan="2">'.$nilai_ex[$i].'</td>';
                      echo "</tr>";
                    }
                    ?>
                    <?php
                    }
                    ?>
                  <?php 
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr class="pagebreak">
              <td colspan="4">
                <?= $note->keterangan; ?>
              </td>
            </tr>
            <tr>
                <td colspan="4" align="left" >
                  <?= $note->catatan; ?>
                </td>
            </tr>
          </table>
          <table class="break" style="width:100%;">
            <tr>
              <td colspan="3" align="center"></td>
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
              <td colspan="4" align="right">FSOP.LKT-15.1.LM</td>
            </tr>
          </table>
        </div>
        <?php 
        }
        ?>
      </div>
    </div>
  </div>
  <!-- <table border='1'>
    <tr>
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
      <td>5</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
    </tr>
    <tr>
      <td>1</td>
      <td rowspan="5">2</td>
      <td rowspan="5">3</td>
      <td rowspan="5">4</td>
      <td rowspan="5">5</td>
      <td rowspan="5">5</td>
      <td rowspan="5">6</td>
      <td rowspan="5">7</td>
    </tr>
    <tr>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
    </tr>
  </table> -->
  <!-- <div class="footer">
    <p style="margin-right: 100px;">FSOP.LKT-15.1.LM</p>
  </div> -->
</section>
</head>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->