<?php 
//test($header,1);
?>
<style>
  @media print{
    @page {
      size: portrait;

    }
  }
  table{
    border-collapse: collapse;
    font-family: arial;
    font-size: 16px;
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
  .bordertengah {
    border: 1px solid #000000b0;
    padding: 5px 5px 5px 5px; 
  }
  p.two {
    border-style: solid;
    border-width: 1px;
  }
  .header{
    padding: 0px; 
  }
  .header_alamat {
    border: 1px solid black;
    padding: 0px; 
    text-align: center;
  }
  .table_detail {
    border-collapse: collapse;
    border: 1px solid black;
  }
  .detail{
    padding: 0px 7px; 
  }
  .table_detail {
    border-collapse: collapse;
    border: 1px solid black;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table style="width:100%">
        <tr>
          <td>
            <table style='width:100%'> 
              <!-- <tr>
                <td align="left" colspan="3" class="header" valign="bottom">
                  <?php 
                  if($header->company_id=='2'){
                    echo '<img alt="" src="'.base_url().'assets/images/sangati_logo.png">';
                  }elseif($header->company_id=='1'){
                    echo '<img width="110" height="90" alt="" src="'.base_url().'assets/images/lm_logo1.png">';
                  }elseif($header->company_id=='3'){
                    echo '<img style="width: 25%;" alt="" src="'.base_url().'assets/images/logo_avon.png">';
                  }elseif($header->company_id=='4'){
                    echo '<img style="width: 25%;" alt="" src="'.base_url().'assets/images/logo-nyaman-only.png">';
                  }elseif($header->company_id=='5'){
                    echo '<img style="width: 25%;" alt="" src="'.base_url().'assets/images/manusia_alam_logo.jpg">';
                  }elseif($header->company_id=='6'){
                    echo '<img style="width: 25%;" alt="" src="'.base_url().'assets/images/eruwork.png">';
                  }elseif($header->company_id=='7'){
                    echo '<img style="width: 25%;" alt="" src="'.base_url().'assets/images/jelantah_logo.png">';
                  }
                  ?>
                </td>
                <td align="left" colspan="1" class="header" valign="bottom" valign="top">
                  <table width="100%">
                    <tr>
                      <td width="10%"><strong></strong></td>
                      <td width="30%"><strong>Print Date</strong></td>
                      <td>: <?php echo tgl_singkat(dbnow()); ?></td>
                    </tr>
                    <tr> 
                      <td><strong></strong></td>
                      <td><strong>Print Time</strong></td>
                      <td>: <?php echo date('H:i:s'); ?></td>
                    </tr>
                  </table>
                </td>
              </tr> -->
              <!-- <tr>
                <td align="left" colspan="2" class="header" valign="bottom">
                  <strong style="font-size: 20px;">
                  <?php 
                  if($header->company_id=='2'){
                    echo "PT SANGATI SOERYA SEJAHTERA";
                  }elseif($header->company_id=='1'){
                    echo 'L&M System Indonesia';
                  }elseif($header->company_id=='3'){
                    echo 'PT Senengnya Pelesiran Avontourier';
                  }elseif($header->company_id=='4'){
                    echo 'PT Beberes Rumah Sejahtera';
                  }elseif($header->company_id=='5'){
                    echo 'PT Manusia Alam Indonesia';
                  }elseif($header->company_id=='6'){
                    echo 'PT Eruwok Soerya Berkat';
                  }elseif($header->company_id=='7'){
                    echo 'PT Sejahtera Karna Menggoreng';
                  }
                  ?>
                </strong>
                </td>
              </tr>
              <tr>
                <td align="left" colspan="4" width='50%'><br/></td>
              </tr> -->
              <?php //test($detail); ?>
              <tr>
                <td colspan='4' align="center">
                  <strong style="font-size: 20px;">
                    <?php 
                    if($header->status_mutasi==1){ 
                      echo "Mutasi Masuk"; 
                    } else if($header->status_mutasi==2){
                      echo "Mutasi Keluar";
                    } else if($header->status_mutasi==4){
                      echo "Mutasi Antar Lokasi";
                    } else {
                      echo "Adjustment";
                    }
                    ?>
                  </strong>
                </td>
              </tr>
              <tr>
                <td align="left" colspan="4" width='50%' class="header_alamat"></td>
              </tr>
              <tr>
                <td align="left" colspan="4" width='50%'><br/></td>
              </tr>
              <tr>
                <td colspan='3' valign="top">
                  <table width="100%">
                    <tr>
                      <td width="35%"><strong>Nomor Mutasi</strong></td>
                      <td>: <?php echo $header->no_mutasi; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Tanggal</strong></td>
                      <td>: <?php echo tgl_singkat($header->tgl); ?></td>
                    </tr>
                  </table>
                </td>
                <td colspan='1' valign="top">
                  <table width="100%">
                    <tr>
                      <td width="10%"><strong></strong></td>
                      <td width="30%"><strong>Lokasi</strong></td>
                      <td>: <?php echo $header->lokasi; ?></td>
                    </tr>
                    <tr>
                      <td><strong></strong></td>
                      <td><strong>Info</strong></td>
                      <td>: <?php echo $header->keterangan; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td align="left" colspan="4" width='50%'><br/></td>
              </tr>
              <tr>
                <td colspan='4'>
                  <table style='width:100%' class="table_detail">
                    <tbody>
                      <tr>
                        <td class='borderdalemcenter' width="3%">No.</td>
                        <td class='borderdalemcenter'>Nama Barang</td>
                        <td class='borderdalemcenter' width="15%">Lot Number</td>
                        <td class='borderdalemcenter' width="15%">Tgl Kadaluarsa</td>
                        <td class='borderdalemcenter' width="10%">Qty</td>
                      </tr>
                    </tbody>
                    <thread>
                      <?php
                      $no     = 0;
                      $max    = 35;
                      $tqty   = 0;
                      foreach ($detail as $key => $value) {
                        $no = $no+1;
                        $bulan          = substr($value->tgl_kadaluwarsa,5,2);
                        $hari           = substr($value->tgl_kadaluwarsa,8,2);
                        $tahun          = substr($value->tgl_kadaluwarsa,0,4);
                        $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
                        ?>
                        <tr>
                          <td class="detail" align="right"><?php echo $no; ?>.</td>
                          <td class="detail"><?php echo $value->nama; ?></td>
                          <td class="detail"><?php echo $value->lot_no; ?></td>
                          <td class="detail"><?= ($tanggal!='01/01/1700')? $tanggal : ''; ?></td>
                          <td class="detail" align="right"><?php echo money($value->qty); ?></td>
                        </tr>
                        <?php 
                        $tqty = $tqty+$value->qty;
                      }
                      ?>
                        
                    </thread>
                  </table>
              <tr>
                <td colspan='4'>
                  &nbsp;
                </td>
              </tr>
                  <table>
                    <tr>
                      <td align="center" width="150px">Received By<br/><br/><br/><br/>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                      <td align="center" width="150px">Checked By<br/><br/><br/><br/>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

</head>
<script>window.print(); setTimeout(function(){window.close();},500);</script>