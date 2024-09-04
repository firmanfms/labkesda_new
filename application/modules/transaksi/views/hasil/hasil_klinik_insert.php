<section class="content-header">
  <h1>
    Transaksi
    <small>Input Hasil Pemeriksaan Klinik</small>
  </h1>
</section>
<?php 
$res_par = array();
foreach ($detail as $key => $val1) {
  $res_par[$val1->kd_kategori_parameter][]=$val1;
}
foreach ($res_par as $key => $value) {
}
// test($detail,1);
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border"></div>
        <form class="form-horizontal" method="post" action="<?php echo base_url().'transaksi/hasil_klinik/insert_act'; ?>">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-3" style="top: 7px;">: Lab Klinik </div>
              <label for="inputEmail3" class="col-sm-2 control-label">Nomor Pendaftaran</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->no_pendaftaran; ?></div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->nama; ?></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->alamat; ?></div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->telp; ?></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Umur</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->umur; ?></div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Dokter</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->dokter; ?></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Diagnosa</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $header->diagnosa_klinik; ?></div>
            </div>
            <div class="form-group">              
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-3" style="top: 7px;">: <?= ($header->jns_kelamin=='W')? 'Wanita' : 'Pria' ; ?></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Inputan</label>
              <div class="col-sm-3" style="top: 7px;">: <?php echo $urut+1; ?></div>
            </div>
            <hr>  
            <div class="col-md-12">
              <p style="font-weight:bold;">
              Contoh Pangkat : ± , 10<span>&#8315;</span><span>&#185;</span> , 10<span>&#8304;</span> , 10<span>&#185;</span> , 10² , 10³ , 10<span>&#8308;</span> , 10<span>&#8309;</span> , 10<span>&#8310;</span> , 10<span>&#8311;</span> , 10<span>&#8312;</span> , 10<span>&#8313;</span> , 10<span>&#185;</span><span>&#8304;</span>  (dapat dicopy paste ke isian hasil)
              </p>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="detail2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Parameter yang diperiksa</th>
                      <th width="13%">Satuan</th>
                      <th>NILAI RUJUKAN</th>
                      <th width="15%">Hasil<br/>Pemeriksaan</th>
                      <th width="15%">Keterangan</th>
                      <th width="25%">Metode Uji</th>
                      <th>Nama Analis</th>
                    </tr>
                  </thead>
                    <?php 
                    $no = 0;
                    foreach ($detail_kdpar as $key => $value) {
                    ?>
                    <tr>
                      <td><u>--&nbsp;&nbsp;<?php echo $value->nm_kategori_parameter; ?>&nbsp;&nbsp;--</u></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php                     
                    foreach ($res_par[$value->kd_kategori_parameter] as $key => $value2) {
                      $no = $no+1;
                      $query_kadar    = $this->db->query("SELECT deskripsi_kadar,id_kadar,nilai_minimum,nilai_maksimum FROM m_kadar WHERE 
                                          kd_parameter='".$value2->kd_parameter."' AND aktif='Y'")->result();
                      $kadar_data     = array();
                      if(count($query_kadar)>=1){
                        $kadar_data   = $query_kadar;
                      }
                    ?>
                    <tr>
                      <td><?php echo $value2->nm_parameter; ?></td>
                      <td><?php echo $value2->satuan; ?></td>
                      <td>
                        <select class="form-control select2 metode_analisa" style="width: 100%;" name="id_kadar[<?php echo $no; ?>]">
                        <?php 
                        echo "<option value='-' selected>-</option> ";
                        // foreach ($kadar_data as $key => $val_kadar) {
                        //   $selected     = "";
                        //   if($val_kadar->id_kadar==$value2->kadar){
                        //     $selected     = "selected";
                        //   }
                        //   echo "<option value='".$val_kadar->deskripsi_kadar."' ".$selected.">".$val_kadar->deskripsi_kadar."</option>";
                        // }
                        foreach ($kadar_data as $key => $val_kadar) {
                          $selected     = "";
                          // if($val_kadar->id_kadar==$value2->kadar){
                           if($val_kadar->deskripsi_kadar==$value2->kadar2){
                            $selected     = "selected";
                          }
                          echo "<option value='".$val_kadar->deskripsi_kadar."' ".$selected.">".$val_kadar->deskripsi_kadar."   </option>";
                        }
                        ?>
                        </select>   
                      </td>
                      <td>
                        <input type="text" class="form-control pull-right" id="nama" name="hasil[<?php echo $no; ?>]" value="<?php echo $value2->nilai; ?>">
                        <input type="hidden" class="form-control pull-right" id="nama" name="no_pendaftaran[<?php echo $no; ?>]" value="<?php echo $value2->no_pendaftaran; ?>">
                        <input type="hidden" class="form-control pull-right" id="nama" name="kd_parameter[<?php echo $no; ?>]" value="<?php echo $value2->kd_parameter; ?>">
                      </td>
                      <td><input type="text" class="form-control pull-right" id="nama" name="keterangan[<?php echo $no; ?>]" value="<?php echo ($value2->ket != null) ? $value2->ket : '-'; ?>"></td>
                      <td>
                        <select class="form-control select2 metode_analisa" style="width: 100%;" id='' name="metode_analisa[<?php echo $no; ?>]">
                          <?php
                          $set1       = '';
                          $set2       = '';
                          $set3       = '';
                          $set4       = '';
                          $set5       = '';
                          if($value2->hasil_analisa==$value2->metode_analisa){
                            $set1       = "selected";
                          }
                          if($value2->hasil_analisa==$value2->metode_analisa2){
                            $set2       = "selected";
                          }
                          if($value2->hasil_analisa==$value2->metode_analisa3){
                            $set3       = "selected";
                          }
                          if($value2->hasil_analisa==$value2->metode_analisa4){
                            $set4       = "selected";
                          }
                          if($value2->hasil_analisa==$value2->metode_analisa5){
                            $set5       = "selected";
                          }
                          ?>
                          <?= ($value2->metode_analisa!='')? '<option value="'.$value2->metode_analisa.'" '.$set1.'>'.$value2->metode_analisa.'</option>' : '' ?>
                          <?= ($value2->metode_analisa2!='')? '<option value="'.$value2->metode_analisa2.'" '.$set2.'>'.$value2->metode_analisa2.'</option>' : '' ?>
                          <?= ($value2->metode_analisa3!='')? '<option value="'.$value2->metode_analisa3.'" '.$set3.'>'.$value2->metode_analisa3.'</option>' : '' ?>
                          <?= ($value2->metode_analisa4!='')? '<option value="'.$value2->metode_analisa4.'" '.$set4.'>'.$value2->metode_analisa4.'</option>' : '' ?>
                          <?= ($value2->metode_analisa5!='')? '<option value="'.$value2->metode_analisa5.'" '.$set5.'>'.$value2->metode_analisa5.'</option>' : '' ?>
                        </select>
                      </td>
                      <td>
                        <select class="form-control select2 metode_analisa" style="width: 100%;" id='' name="nama_analis[<?php echo $no; ?>]">
                          <?php 
                          foreach ($data_analis as $key => $value) {
                            $selected   = '';
                            if($value2->nama_analis==$value->nama){
                              $selected   = "selected";
                            }
                            echo "<option value='".$value->nama."' ".$selected.">".$value->nama."</option>";
                          }
                          ?>                          
                        </select>
                        <!-- <input type="text" class="form-control pull-right" id="nama" name="nama_analis[<?php echo $no; ?>]" value="<?php echo $value2->nama_analis; ?>"> -->
                      </td>
                    </tr>
                    <?php
                    }
                    }
                    ?>         
                </table>
                <input type="hidden" class="form-control pull-right" id="no" name="no" value="<?php echo $no; ?>">
                <input type="hidden" class="form-control pull-right" id="no" name="urut" value="<?php echo $value2->urutan_pengujian; ?>">
              </div>
            </div>   
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-info" id="save">Simpan</button>
            <a href="<?php echo base_url('transaksi/hasil_klinik/'); ?>" type="submit" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php //test($new_klinik,0); ?>
<script>
$(document).ready(function(){
  $('.metode_analisa').select2();
  metode = {
    data: {},
    processed: false,
    items: [],
    init: function(){
      this.grids = $('#detail2').DataTable({
        "paging": false, 
        "bLengthChange": false, // disable show entries dan page
        "bFilter": false,
        "bInfo": false, // disable Showing 0 to 0 of 0 entries
        "bAutoWidth": false,
        "language": {
            "emptyTable": "Tidak Ada Data"
        },
        columns: [
          { 
            bVisible  : false,
            data      : 'kd_kategori_parameter' 
          },
          { data: 'nm_kategori_parameter', className: "text-left" }, 
          { data: 'act', className: "text-center" }
        ],
      });
    },
  };
  metode.init();
});
</script>