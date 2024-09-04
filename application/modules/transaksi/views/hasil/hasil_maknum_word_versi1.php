<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
  // test($value,0);
}
// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment;Filename=".str_replace("/","",$header->no_pendaftaran).".doc");
?>
<style>
  .content {
    font-size: 13px !important;
  }
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
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
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
                    <td colspan="4" align="center" style="height:70"></td>
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
              <td width="25%">No. Lab</td>
              <td width="35%">: <?php echo $header->no_pendaftaran; ?></td>
              <td width="20%"></td>
              <td width="20%"></td>
            </tr>
            <tr>
              <td>Pemilik</td>
              <td>: <?php echo ucwords(strtolower($header->nama));?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Nama Sampel</td>
              <td>: <?php echo $header->uraian_sampel; ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Banyak Sampel</td>
              <td>: <?php echo $header->banyak; ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td colspan='2'>: <?php echo $header->alamat; ?></td>
              <td></td>
            </tr>
            <tr>
              <td>Jenis Sampel</td>
              <td>: <?php echo $header->nm_sampel; ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Ketrangan Sampel</td>
              <td>: <?php echo $header->ket_sampel.'/'.$header->kondisi; ?></td>
              <td></td>
              <td></td>
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
              <td colspan="4">
                <table style="width:100%;font-family: 'Times New Roman', Times, serif;border: 1px solid black;font-size: 13px">
                  <tr style="border: 1px solid black;background-color: #adadad;font-weight: 600">
                    <td width='20%'> Pemeriksaan</td>
                    <td width='15%'>Hasil Pemeriksaan</td>
                    <td>Kadar Maksimum yang Diperbolehkan </td>
                    <td>Metode Uji</td>
                  </tr>
                  <?php 
                  $total    = 0; 
                  foreach ($detail_kdpar as $key => $value) {
                  $nm_kategori_parameter     = $value->nm_kategori_parameter;
                  ?>
                  <tr style="border: 1px solid black">
                    <td>-- &nbsp;&nbsp;<?php echo $nm_kategori_parameter; ?> --</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                    <?php
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value) {
                    $total    = $total+$value->harga;
                    $nilai    = str_replace(";","<br/>",$value->nilai);
                    $bold     = $nilai;
                    if($value->nilai_min!='0.00' AND $value->nilai_max!='0.00'){
                      if($value->nilai > $value->nilai_min AND $value->nilai_max > $value->nilai){
                        $bold     = $nilai;
                      }else{
                        $bold     = "<strong><u>".$nilai."</u></strong>";
                      }
                    }
                    ?>
                    <tr style="border: 1px solid black">
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->nm_parameter; ?></td>
                      <td align="center"><?php echo $bold.' '.$value->nilai.' '.$value->nilai_max; ?></td>
                      <td align="center"><?php echo $value->kadar; ?></td>
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
                <td colspan="4"><?= $note->keterangan; ?></td>
            </tr>
            <tr>
                <td colspan="4">Syarat berdasarkan pada :</td>
            </tr>
            <tr>
                <td colspan="4">1. Perka BPOM RI No. 13 Tahun 2019, Tentang Kriteria Mikrobiologi Dalam pangan Olahan</td>
            </tr>
            <tr>
                <td colspan="4">2. Perka BPOM RI No. 11 Tahun 2019, Tentang Bahan Tambahan Pangan.</td>
            </tr>
            </table>
          <table class="break" style="width:100%;font-family: 'Times New Roman', Times, serif;font-size: 13px">
            <tr>
              <td colspan="2" align="center">Mengetahui,</td>
              <td colspan="2" align="center">Tangerang, <?= tgl_singkat(dbnow()); ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center">Kepala UPT LABKESDA </td>
                <td colspan="2" align="center">Penanggung Jawab Teknis</td>
            </tr>
            <tr>
                <td colspan="2" align="center">Dinas Kesehatan Kota Tanggerang</td>
                <td colspan="2" align="center" > </td>
            </tr>
            <tr>
                <td colspan="2" align="center" height='100'> </td>
                <td colspan="2" align="center"> </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><u><?= $ttd_kepala->nama; ?></u></td>
                <td colspan="2" align="center"><u><?= $ttd_teknis->nama; ?></u></td>
            </tr>
            <tr>
                <td colspan="2" align="center" height='25'>NIP. <?= $ttd_kepala->nip; ?></td>
                <td colspan="2" align="center">NIP. <?= $ttd_teknis->nip; ?></td>
            </tr>
            <tr>
                <td colspan='4'><?= $note->keterangan; ?></td>
            </tr>
            <tr>
                <td colspan='3' align="right"></td>
                <td align="right">FSOP.LKT-15.1</td>
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
      </div>
    </div>
  </div>
</section>
</head>
<!-- <script>window.print(); setTimeout(function(){window.close();},500);</script> -->