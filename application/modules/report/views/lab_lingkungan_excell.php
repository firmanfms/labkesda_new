<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_".$kd_lab.".xls");
?>
<?php 
if($tgl_dari!=''){
/*$arr_katpar   = array();
$arr_par      = array();
$arr_par2     = array();
$arr_par3     = array();
$arr_header   = array();*/
foreach ($pendaftaran as $key => $value1) {
  /*$arr_katpar[$value1->kd_kategori_parameter]                       = $value1;
  $arr_par[$value1->kd_kategori_parameter][$value1->kd_parameter]   = $value1;
  $arr_par2[$value1->no_pendaftaran][$value1->kd_parameter]         = $value1->nilai;
  $arr_par3[$value1->kd_parameter]                                  = $value1;
  $arr_header[$value1->no_pendaftaran]                              = $value1;*/
}
// pre($arr_header);exit();
// test($arr_par3,1);
?>
<!-- tambah Pencarian Lab -->
  <table border='1'>
    <thead>
      <tr>
        <th width="3%">No.</th>
        <th width="9%">Tgl Terima</th>
        <th width="9%">Nama</th>
        <th>Alamat</th>         
        <th >Jenis Sampel</th>
        <th>Kategori Parameter</th>
        <?php 
		$query_par = "select mkp.nm_kategori_parameter,mp.nm_parameter
					from t_pendaftaran tp 
					join t_pendaftaran_detail tpd on tpd.no_pendaftaran=tp.no_pendaftaran 
					join m_parameter mp on mp.kd_parameter=tpd.kd_parameter 
					join m_kategori_parameter mkp on mkp.kd_kategori_parameter=mp.kd_kategori_parameter 
					where 
					tp.tgl_input between '".$tgl_dari." 00:00:00' and '".$tgl_smp." 23:59:59'
					and tp.kd_lab ='".$value1->kd_lab."'
					group by mkp.nm_kategori_parameter,mp.nm_parameter
					order by mkp.zorder,mp.zorder";
		$par  = $this->db->query($query_par)->result();
        foreach ($par as $key => $value2) {
        //foreach ($arr_par3 as $key => $value2a) {
        ?>
          <th><?php /*echo $value2a->nm_parameter.' '.$value2a->kd_parameter;*/ echo $value2->nm_parameter; ?></th>
        <?php
		}
        //}
        ?>          
        <!-- <th>Tanggal Terima</th>          -->
      </tr>
      <tr>
      </tr>
    </thead>
    <tbody>
    <?php         
    $no     = 0;
    foreach ($pendaftaran as $key => $value) {
      $no     = $no+1;
    ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= tgl_singkat($value->tgl_diterima); ?></td>
      <td><?= $value->nama; ?><br/><?= $value->no_pendaftaran; ?></td>
      <td><?= $value->alamat; ?></td>
      <td><?php /*echo ($value->nm_sampel!=0)? $value->nm_sampel : '';*/ echo $value->nm_sampel; ?></td>
      <td><?php //echo $value->nm_kategori_parameter; ?></td>
      <?php 
        /*foreach ($arr_par3 as $key => $value3b) {
          $query    = $this->db->query("SELECT b.nilai FROM t_pendaftaran a LEFT JOIN t_pendaftaran_detail b ON a.no_pendaftaran=b.no_pendaftaran 
            WHERE b.kd_parameter='".$value3b->kd_parameter."' AND a.no_pendaftaran='".$value->no_pendaftaran."'");
          if($query->num_rows()>=1){
            $nilai    = $query->row()->nilai;
          }else{
            $nilai    = "";
          }*/
          // if($value3b->kd_parameter!=''){
          //   $nilai    = $arr_par2[$value->no_pendaftaran][$value3b->kd_parameter];
          // }else{
          //   $nilai    = '';
          // }
          ?>
            <td><?php //echo $nilai; ?></td>
          <?php
        //}
      ?>  
      <!-- <td><?php //echo $value->tgl_diterima; ?></td> -->
    </tr>
    <?php 
    }
    ?>
  </table>
<?php 
}
?>
