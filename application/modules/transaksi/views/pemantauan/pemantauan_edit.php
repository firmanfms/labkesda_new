<section class="content-header">
  <h1>
    Transaksi
    <small>Update Pemantapan Mutu Internal</small>
  </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form class="form-horizontal" method="post" action="<?php echo base_url().'transaksi/pemantauan/update_act'; ?>">
                    <div class="box-body">
                      <table id="itemsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <!-- <th>No Pendaftaran</th> -->
                                <th width="12%">No Pendaftaran</th>
                                <th>Parameter</th>
                                <th>Sampel</th>
                                <th width="8%">P1</th>
                                <th width="8%">P2</th>
                                <th width="8%">Blanko</th>
                                <th width="8%">Rec</th>
                                <th width="8%">CRM</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($pilih as $key => $value) {
                            // test($value,1);
                            // 'no_pendaftaran'        => $no_pendaftaran,
                            //     'kd_parameter'          => $kd_parameter,
                            //     'kd_sampel'             => $detail->kd_sampel,
                            //     'nm_sampel'             => $detail->nm_sampel,
                            //     'nm_parameter'          => $detail->nm_parameter,
                            //     'kd_kategori_parameter' => $detail->kd_kategori_parameter,
                            //     'nm_kategori_parameter' => $detail->nm_kategori_parameter
                        ?>
                        <tr>
                            <td>
                              <?php echo $value['no_pendaftaran']; ?>
                              <input class="form-control pull-right" type="hidden" name="no_pendaftaran" value="<?= $value['no_pendaftaran'] ?>">
                              <input class="form-control pull-right" type="hidden" name="kd_sampel" value="<?= $value['kd_sampel'] ?>">
                              <input class="form-control pull-right" type="hidden" name="kd_parameter" value="<?= $value['kd_parameter'] ?>">
                              <input class="form-control pull-right" type="hidden" name="id_mutu_internal" value="<?= $value['id_mutu_internal'] ?>">
                            </td>
                            <td><?php echo $value['nm_parameter']; ?></td>
                            <td><?= ($value['nm_sampel']!='0')? $value['nm_sampel'] : ''; ?></td>
                            <td><input class="form-control pull-right" type="text" name="p1" value="<?= $value['p1'] ?>"></td>
                            <td><input class="form-control pull-right" type="text" name="p2" value="<?= $value['p2'] ?>"></td>
                            <td><input class="form-control pull-right" type="text" name="blanko" value="<?= $value['blanko'] ?>"></td>
                            <td><input class="form-control pull-right" type="text" name="rec" value="<?= $value['rec'] ?>"></td>
                            <td><input class="form-control pull-right" type="text" name="crm" value="<?= $value['crm'] ?>"></td>                        
                        </tr>
                        <?php 
                        }
                        ?>
                      </table>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-info" id="save">Simpan</button>
                      <a href="<?php echo base_url('transaksi/pemantauan/'); ?>" type="submit" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php //test($new_klinik,0); ?>

<script>
$(document).ready(function(){
  // $(':checkbox').change(function() {
  //   debugger
  //   var data  = $('#kd_mdetode').val()
  //     alert(data)      
  // });
  // $('#kd_lab').select2();
  $('#kd_sampel').select2();
  $('#kd_kategori_parameter').select2();
  $('#tanggal').datepicker({
    setDate: new Date(),
    autoclose: true
  });

  metode = {
    data: {},
    processed: false,
    items: []
  };
  metode.init();
});
</script>