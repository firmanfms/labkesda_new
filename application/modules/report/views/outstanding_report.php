<section class="content-header">
  <h1>
    Report
    <small>View Sampel Outstanding</small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a style="color: white" type="submit" class="btn btn-block btn-primary" href="<?php echo base_url('transaksi/mutasi_keluar/form'); ?>">Input</a></li> -->
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <form class="form-horizontal" action="<?= base_url('report/laboratorium/outstanding'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Laboratorium</label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='kd_lab' name="kd_lab">
                  <option disabled="" >- Pilih -</option>
                  <?php 
                  foreach ($data_lab as $key => $value) {
                    $selected       = '';
                    if($value->kd_lab==$kd_lab){
                      $selected     = 'selected=""';
                    }
                    echo "<option value='".$value->kd_lab."' ".$selected.">".$value->lab."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control select2" style="width: 100%;" id='status' name="status">
                  <option disabled="" >- Pilih -</option>
                  <option value="1" <?= ($status==1)? 'selected=""' : ''; ?>>Belum Input Hasil</option>
                  <option value="2" <?= ($status==2)? 'selected=""' : ''; ?>>Approve Koordinator</option>
                  <option value="3" <?= ($status==3)? 'selected=""' : ''; ?>>Approve PJT</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <!-- <button type="submit" class="btn btn-info" id="add-items">Excell</button> -->
                <?php 
                if($kd_lab!=''){
                ?>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/laboratorium/outstanding_excell/'.$kd_lab.'/'.$status); ?>">Excell</a>
                <?php 
                }
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="box">
        <div class="box-body">
          <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>No Pendaftaran</th>
                <th>Nama</th>
                <th>Laboratorium</th>
                <th>Sampel</th>
                <th>Tgl Terima</th>
                <th>Tgl Pengujian</th>
                <th>Tgl Selesai</th>
                <th>Waktu Jatuh Tempo</th>
                <th>Approve</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no         = 0; 
                foreach ($pendaftaran as $key => $value) {
                  // test($value,1);
                $no         = $no+1;
                $selisih    = '';

                if($value->status_approve==3){
                  $status     = "Approve PJT";
                }else if($value->status_approve==2){
                  $status     = "Approve Koordinator";
                }else if($value->status_approve==4){
                  $status     = "Reject PJT";
                }else{
                  $status     = "Input Hasil";
                }

                $tgl1     = new DateTime(dbnow(false));
                $tgl2     = new DateTime($value->tgl_selesai);
                $jarak    = $tgl2->diff($tgl1);

                $selisih  = '';
                if($value->tgl_selesai){
                  $selisih  = $jarak->d;
                }

              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?php echo $value->no_pendaftaran; ?></td>
                <td><?php echo $value->nama; ?></td>
                <td><?php echo $value->lab; ?></td>
                <td><?php echo $value->nm_sampel; ?></td>
                <td><?php echo tgl_singkat($value->tgl_diterima); ?></td>
                <td><?php echo tgl_singkat($value->tgl_pengujian); ?></td>
                <td><?php echo tgl_singkat($value->tgl_selesai); ?></td>
                <td><?php echo $selisih; ?></td>
                <td><?= $status; ?></td>
              </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script>

$(document).ready(function(){
  $('#kd_lab').select2();
  $('#status').select2();
  $('.tanggal').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });

  $('#id_lokasi').select2();
  $('#month').select2();
  $('#year').select2();
  $('#id_barang').select2();

  $('#itemsTable').DataTable({
    "ordering": false,
    "bPaginate": false
  });

})
</script>