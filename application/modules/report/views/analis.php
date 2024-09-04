<section class="content-header">
  <h1>
    Report
    <small>View Rekap Per Analis</small>
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
          <form class="form-horizontal" action="<?= base_url('report/analis'); ?>" method='POST'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_dari_asli" name="tgl_dari" value="<?= $tgl_dari_asli; ?>" placeholder="Tanggal">
              </div>
              <div class="col-sm-1">
                s/d
              </div>
              <div class="col-sm-2">
                <input type="text" class="tanggal form-control pull-right" id="tgl_smp_asli" name="tgl_smp" value="<?= $tgl_smp_asli; ?>" placeholder="Tanggal">
              </div>
            </div>
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
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-warning" id="add-items">Cari</button>
                <!-- <button type="submit" class="btn btn-info" id="add-items">Excell</button> -->
                <?php 
                if($kd_lab!=''){
                ?>
                <a class="btn btn-info" target="_blank" href="<?= base_url('report/analis/excell/'.$tgl_dari.'/'.$tgl_smp.'/'.$kd_lab); ?>">Excell</a>
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
          <table id="itemsTable" class="table table-bordered table-striped table-hover display compact nowrap">
            <thead>
              <tr>
              <!-- SELECT 
a.tgl_pengujian , b.no_pendaftaran , a.kd_lab , b.kd_parameter , b.nama_analis
  , c.nm_parameter
FROM t_pendaftaran a
LEFT JOIN t_pendaftaran_detail b ON a.`no_pendaftaran`=b.`no_pendaftaran`
LEFT JOIN m_parameter c ON b.`kd_parameter`=c.`kd_parameter`
LEFT JOIN m_lab d ON a.kd_lab=d.kd_lab
LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=b.kd_kategori_parameter
WHERE a.`kd_lab`='LL' AND a.`tgl_input` BETWEEN '2024-01-01 00:00:00' AND '2024-03-30 23:00:00'
 ORDER BY e.nm_kategori_parameter -->
                <td>No.</td>
                <td>Tanggal Pengujian</td>
                <td>No. Pendaftaran</td>
                <td>Laboratorium</td>
                <td>Nama Parameter</td>
                <td>Nama Analis</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $no         = 0; 
                foreach ($pendaftaran as $key => $value) {
                $no         = $no+1;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= kiri($value->tgl_pengujian,10); ?></td>
                <td><?= $value->no_pendaftaran; ?></td>
                <td><?= $value->kd_lab; ?></td>
                <td><?= $value->nm_parameter; ?></td>
                <td><?= $value->nama_analis; ?></td> 
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
    "bPaginate": false,
  });
})
</script>